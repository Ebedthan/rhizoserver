<?php
if(isset($_POST['save'])) {
    if(!empty($_POST['search'])) {
        $search = $_POST['search'];
        $stmt = $link->prepare("SELECT * FROM Genomes, Taxonomy WHERE Genomes.name like '%$search%' or Genome.gID like '%$search%' or Taxonomy.rsFamily like '%$search%' or Taxonomy.rsGenus like '%$search%' or Taxonomy.rsSpecies like '%$search%'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("genomes.php?result=$result");
    }
}
?>
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="assets/images/rhizo_brand.png" width="50" height="auto" alt="RhizoServer logo">
            RhizoServer
        </a>
        <form method='post' class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search Rhizobia" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="save">Search</button>
        </form>
    </div>
</nav>