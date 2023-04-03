<?php 
session_start();
require_once 'config.php';
include 'functions.php';
?>
<?=template_header("Results")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <?php
            if(isset($_GET["job_id"])) {
            ?>
            <div class="col-8">
                <div class="row text-center" style="margin-top: 1.56em; margin-bottom: 1.56em;">
                    <h3>View FastANI result</h3>
                </div>
                <div class="row">
                    <label for="jobID" class="form-label">Job ID</label>
                    <input id="jobID" class="form-control" type="text" value="<?php echo $_GET["job_id"]; ?>" aria-label="job id" readonly>
                    <br/>
                    <br/>
                    <div class="card">
                        <h5 class="card-header">Results</h5>
                        <div class="card-body text-bg-dark">
                        <?php
                            $sql = 'SELECT jobid, query, reference, kmer, fragLen, minFrac, startDate, endDate FROM FastANI WHERE jobid = ?';
                            $stmt = mysqli_prepare($link, $sql);
                            $stmt->bind_param("s", $_GET["job_id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if (is_null($row)) {
                                echo "Job ID not found, be sure to have launched FastANI from analysis.php"; 
                            } else {
                                echo "FastANI v1.33";
                                echo "Kmer length: " . $row['kmer'];
                                echo "Fragment length: " . $row['fragLen'];
                                echo "Minimum fraction of genome: " . $row['minFrac'];
                                echo "Start Date: " . date("F j, Y, g:i a", $row['startDate']);
                                $run = "";

                                do {
                                    $status = get_fastani_status($_GET["job_id"]);
                                    $run .= '.';
                                    echo $run;
                                }
                                while ($status != "finished" || $status != "failed");
                                $res = get_fastani_result($_GET["job_id"]);
                                echo "Query: " . $r["data"]["query"];
                                echo "Reference: " . $r["data"]["reference"];
                                echo "Command: " . $r["data"]["cmd"];
                                echo $r["data"]["stderr"];
                                if ($status == "finished") {
                                    foreach ($res["results"] as $r) {
                                        echo "ANI: " . $r["data"]["ani"];
                                        echo "AF: " . $r["data"]["af"];
                                        echo "Mapped: " . $r["data"]["mapped"];
                                        echo "Total: " .$r["data"]["total"];
                                    }
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            } else {
            ?>
            <div class="col-8">
                <div class="row text-center" style="margin-top: 1.56em; margin-bottom: 1.56em;">
                    <h3>View FastANI results</h3>
                    <div class="alert alert-success" role="alert">
                        Add Job ID to see result.
                    </div>
                </div>
                <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="jobID" class="form-label">Job ID</label>
                    <input id="jobID" name="job_id" class="form-control" type="text" aria-label="job id" required>
                    <br/><br/>
                    <div class="row text-center">
                        <div class="col">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }
            ?>
            <div class="col-2"></div>
        </div>
    </div>
</body>