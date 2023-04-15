<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Search genomes")?>
<link rel="stylesheet" type="text/css" href="assets/datatables.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row align-items-center z-0">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col g-4">
                            <h3> Searching all genomes</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="gy-5">
                            <table id="genomeTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="selectAll" name="selectAll" value="all"></th>
                                        <th>Name</th>
                                        <th>Species</th>
                                        <th>Category</th>
                                        <th>Quality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT gid, name, genome_category, checkm_completeness, checkm_contamination FROM Genomes";
                                    $result = mysqli_query($link, $sql);
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td><a style='color: #000; text-decoration:none;' href='genome.php?gid=".$row["gid"]."'>".$row["gid"]."</a></td>";
                                        echo "<td><i>".$row["name"]."</i></td>";
                                        if ($row["genome_category"] == "derived from metagenome" || $row["genome_category"] == "derived from environmental sample") {
                                            echo "<td>MAG</td>";
                                        } else {
                                            echo "<td>Isolate</td>";
                                        }
                                        if ($row["checkm_completeness"] >= 80 && $row["checkm_contamination"] < 5) {
                                            echo "<td>High</td>";
                                        } elseif ($row["checkm_completeness"] >= 50 && $row["checkm_contamination"] < 10 ) {
                                            echo "<td>Medium</td>";
                                        } else {
                                            echo "<td>Low</td>";
                                        }
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type="checkbox" class="selectAll" name="selectAll" value="all"></th>
                                        <th>Name</th>
                                        <th>Species</th>
                                        <th>Category</th>
                                        <th>Quality</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php mysqli_free_result($result); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="assets/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#genomeTable').DataTable({
                "pageLength": 25,
                stateSave: true,
                select: true,
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
            });
        });

        $(document).ready( function () {
            var DT1 = $('#genomeTable').DataTable();
            $(".selectAll").on( "click", function(e) {
                if ($(this).is( ":checked" )) {
                    DT1.rows({page:'current'}).select();        
                } else {
                    DT1.rows({page:'current'}).deselect(); 
                }
            });
        });
    </script>
    <?=template_footer()?>