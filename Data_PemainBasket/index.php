<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Data Pemain Basket</title>
</head>

<body>
  <!-- Connector untuk menghubungkan PHP dan SPARQL -->
  <?php
  require_once("sparqllib.php");
  $test = "";
  if (isset($_POST['search'])) {
    $test = $_POST['search'];
    $data = sparql_get(
      "http://localhost:3030/datapemain",
      "
            PREFIX id: <https://datapemain.com/> 
      PREFIX item: <https://datapemain.com/ns/item#> 
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
      SELECT ?nama ?tinggi ?berat ?tanggal_lahir ?negara ?klub 
      WHERE
            { 
              ?items
              item:nama                 ?nama ;
              item:tinggi               ?tinggi ;
              item:berat                ?berat ;
              item:tanggal_lahir        ?tanggal_lahir ;
              item:negara               ?negara ;
              item:klub                 ?klub .
                    FILTER 
                    (regex (?nama, '$test', 'i') 
                    || regex (?tinggi, '$test', 'i') 
                    || regex (?berat, '$test', 'i') 
                    || regex (?tanggal_lahir, '$test', 'i') 
                    || regex (?negara, '$test', 'i') 
                    || regex (?klub, '$test', 'i'))
                    }"
    );
  } else {
    $data = sparql_get(
      "http://localhost:3030/datapemain",
      "
      PREFIX id: <https://datapemain.com/> 
      PREFIX item: <https://datapemain.com/ns/item#> 
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
      SELECT ?nama ?tinggi ?berat ?tanggal_lahir ?negara ?klub 
      WHERE
            { 
              ?items
              item:nama                 ?nama ;
              item:tinggi               ?tinggi ;
              item:berat                ?berat ;
              item:tanggal_lahir        ?tanggal_lahir ;
              item:negara               ?negara ;
              item:klub                 ?klub .
                 
             }
            "
    );
  }

  if (!isset($data)) {
    print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
  }
  ?>



  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="index.php"><img src="images/FIBA.png" style="width:50px" alt="Logo"></a>
      <a class="navbar-brand" href="#">Data Pemain</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

      </ul>
      <form class="d-flex" role="search" action="" method="post" id="nameform">
        <input class="form-control me-2" type="search" placeholder="Ketik keyword disini" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <div class="container container-fluid mt-3  ">
    <i class="fa-solid fa-magnifying-glass"></i><span>Menampilkan hasil pencarian untuk "<?php echo $test; ?>"</span>
    <table class="table table-bordered table-striped table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th>No.</th>
          <th>Nama Pemain Basket</th>
          <th>Tinggi Pemain</th>
          <th>Berat Pemain</th>
          <th>Tanggal Lahir </th>
          <th>Negara</th>
          <th>Klub</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; ?>
        <?php foreach ($data as $dat) : ?>
          <tr>
            <td></td>
            <td><?= $dat['nama'] ?></td>
            <td><?= $dat['tinggi'] ?></td>
            <td><?= $dat['berat'] ?></td>
            <td><?= $dat['tanggal_lahir'] ?></td>
            <td><?= $dat['negara'] ?></td>
            <td><?= $dat['klub'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>


</body>

</html>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>