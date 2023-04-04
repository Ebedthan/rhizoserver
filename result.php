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
                    <div class="card gy-4">
                        <h5 class="card-header">Results</h5>
                        <div class="card-body text-bg-dark g-2">
                        <?php
                            $sql = 'SELECT jobid, query, reference, kmer, fragLen, minFrac, startDate FROM FastANI WHERE jobid = ?';
                            $stmt = mysqli_prepare($link, $sql);
                            $stmt->bind_param("s", $_GET["job_id"]);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if (is_null($row)) {
                                echo "Job ID not found, be sure to have launched FastANI from <a href='https://rhizoserver.org/analysis.php'>our analysis page</a>"; 
                            } else {
                                echo "FastANI v1.33" . "<br/>";
                                echo "Kmer length: " . $row['kmer'] . "<br/>";
                                echo "Fragment length: " . $row['fragLen'] . "<br/>";
                                echo "Minimum fraction of genome: " . $row['minFrac'] . "<br/>";
                                echo "Start Date: " . $row['startDate'] . "<br/>";
                                $status = get_fastani_status($_GET["job_id"]);
                                if ($status == "failed") {
                                    $res_json = get_fastani_result($_GET["job_id"]);
                                    foreach ($res_json->results as $res) {
                                        echo "Query: " . $res->query . "<br/>";
                                        echo "Reference: " . $res->reference . "<br/>";
                                        echo "Command: " . $res->data->cmd . "<br/>";
                                        echo $res->data->stderr . "<br/>";
                                    }
                                } elseif ($status == "finished") {
                                    $res_json = get_fastani_result($_GET["job_id"]);
                                    foreach ($res_json->results as $res) {
                                        echo "Query: " . $res->query . "<br/>";
                                        echo "Reference: " . $res->reference . "<br/>";
                                        echo "Command: " . $res->data->cmd . "<br/>";
                                        echo "ANI: " . $res->data->ani . "<br/>";
                                        echo "AF: " . $res->data->af . "<br/>";
                                        echo "Mapped: " . $res->data->mapped . "<br/>";
                                        echo "Total: " . $res->data->total . "<br/>";
                                    }
                                } else {
                                    echo "Running...";
                                }
                            }
                        ?>
                        </div>
                        <br><br>
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