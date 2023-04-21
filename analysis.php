<?php
session_start();
require_once 'config.php';
include 'functions.php';

// form handling
$query_error = $ref_error = $kmer_error = $minfrac_error = $email_error = "";
$kmer = $frag_len = $min_frac = 0;
$query = $ref = $email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["inputQuery"])) {
        $query_error = "Query name required";
    } elseif (empty($_POST["inputRef"])) {
        $ref_error = "Reference name required";
    } else {
        if (empty($_POST["inputKmer"])) {
            $kmer = 16;
        } elseif ($_POST["inputKmer"] < 0 || $_POST["inputKmer"] > 16) {
            $kmer_error = "Kmer length should be between 1 and 16";
        } else {
            $kmer = sanitize($_POST["inputKmer"]);
        }

        if (empty($_POST["inputFrag"])) {
            $frag_len = 3000;
        } else {
            $frag_len = sanitize($_POST["inputFrag"]);
        }

        if (empty($_POST["inputMinFrac"])) {
            $min_frac = 0.2;
        } elseif ($_POST["inputMinFrac"] < 0 || $_POST["inputMinFrac"] > 16) {
            $min_frac_error = "Minimum fraction should be between 0 and 1";
        } else {
            $min_frac = sanitize($_POST["inputMinFrac"]);
        }
        if (empty($_POST["email"])) {
            $email = "";
        } else {
            $email = sanitize($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Invalid email format";
            }
        }
        if (empty($query_error) && empty($ref_error) && empty($kmer_error) && empty($minfrac_error) && empty($email_error)) {
            $query = sanitize($_POST["inputQuery"]);
            $ref = sanitize($_POST["inputRef"]);

            // sending api request
            $response = fastani($query, $ref, $kmer, $frag_len, $min_frac, $email);
            $response_json = json_decode($response, true);
            $startDate = date("F j, Y, g:i a");

            // Write data to DB
            $stmt = $link->prepare("INSERT INTO FastANI (jobid, query, reference, kmer, fragLen, minFrac, startDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiidsss", $response_json["job_id"], $query, $ref, $kmer, $frag_len, $min_frac, $startDate);
            $stmt->execute();

            header("Location:result.php?job_id=".$response_json["job_id"]);
        }
    }
}
?>
<?=template_header("Analysis")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row z-0">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="row text-center" style="margin-top: 1.56em; margin-bottom: 1.56em;">
                    <h3>Compute ANI between genomes</h3>
                    <div class="alert alert-warning" role="alert">
                        Only genomes found in RhizoServer or NCBI can be used and should be identified by their name!
                    </div>
                </div>
                <div class="row">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputQuery" class="form-label">Query</label>
                                <input id="inputQuery" name="inputQuery" class="form-control" placeholder="GCA_123456789.1" type="text" required>
                                <div class="invalid-feedback"><?php echo $query_error; ?></div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputReference" class="form-label">Reference</label>
                                <input id="inputReference" name="inputRef" class="form-control" placeholder="GCA_123456789.1" type="text" required>
                                <div class="invalid-feedback"><?php echo $ref_error; ?></div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                                <div class="invalid-feedback"><?php echo $email_error; ?></div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="kmerText" class="form-label">Kmer length</label>
                                <input type="number" name="inputKmer" class="form-control" placeholder="16" id="kmerText">
                                <div class="invalid-feedback"><?php echo $kmer_error; ?></div>
                            </div>
                            <div class="col-md-4">
                                <label for="fragLenText" class="form-label">Fragment length</label>
                                <input type="number" name="inputFrag" class="form-control" placeholder="3000" id="fragLenText">
                                <div class="invalid-feedback"><?php echo $frag_error; ?></div>
                            </div>
                            <div class="col-md-4">
                                <label for="minFracText" class="form-label">Minimum fraction of genome</label>
                                <input type="number" name="inputMinFrac" class="form-control" placeholder="0.2" id="minFracText">
                                <div class="invalid-feedback"><?php echo $minfrac_error; ?></div>
                            </div>
                        </div>
                        <br/>
                        <div class="row text-center">
                            <div class="col">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <?=template_footer()?>

