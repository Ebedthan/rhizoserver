<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Search 16S sequences")?>
<link rel="stylesheet" type="text/css" href="assets/datatables.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col g-4">
                            <h3> Searching all 16S sequences</h3>
                            <p><i>The below-listed 16S rRNA sequences are predicted using covariant models</i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="gy-5">
                            <table id="genomeTable" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="selectAll" name="selectAll" value="all"></th>
                                        <th>Accession</th>
                                        <th>Species</th>
                                        <th>Genus</th>
                                        <th>Copy Number</th>
                                        <th>Genome completness</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT Genomes.gID, Genomes.isComplete, Taxonomy.rsGenus, Taxonomy.rsSpecies, 16S.genome_ID, 16S.copyNumber FROM Genomes, Taxonomy, 16S WHERE Genomes.ID = Taxonomy.genome_id AND Genomes.ID = 16S.genome_ID";
                                    $result = mysqli_query($link, $sql);
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td><a style='color: #000; text-decoration:none;' href='genome.php?gid=".$row["gID"]."'>".$row["gID"]."</a></td>";
                                        echo "<td><i>".array_values(explode("__", $row["rsSpecies"], 2))[1]."</i></td>";
                                        echo "<td><i>".array_values(explode("__", $row["rsGenus"], 2))[1]."</i></td>";
                                        echo "<td>".$row["copyNumber"]."</td>";
                                        $iscomplete = "";
                                        if($row["isComplete"] == 0) {
                                            $iscomplete = 'Fragment'; 
                                        } else { 
                                            $iscomplete = 'Complete'; 
                                        }
                                        echo "<td>".$iscomplete."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type="checkbox" class="selectAll" name="selectAll" value="all"></th>
                                        <th>Accession</th>
                                        <th>Species</th>
                                        <th>Genus</th>
                                        <th>Copy Number</th>
                                        <th>Genome completness</th>
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
                stateSave: true,
                select: true,
                dom: 'Bfrtip',
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                buttons: [
                    'copy', 'csv', 'pdf',
                    {
                        text: 'Select everything',
                        action: function () {
                            table.rows().select();
                        }
                    },
                    {
                        text: 'Deselect everything',
                        action: function () {
                            table.rows().deselect();
                        }
                    }
                ]
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

