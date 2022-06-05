<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
        CekBMI
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
              font-family: Arial, Helvetica, sans-serif;
              background-color: #FAFAFF;
            }
            .navbar {
                background-color: #30343f;
            }
        </style>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <?php
  require_once("sparqllib.php");
  $test = "";
  if (isset($_POST['search-data'])) {
    $test = $_POST['search-data'];
    $data = sparql_get(
      "http://ngrok:3030/dataBMI",
      "
      prefix info: <http://learningsparql.com/ns/addressbook#> 
      prefix data:  <http://learningsparql.com/ns/data#> 
      SELECT ?name ?jk ?usia ?bb ?tb ?bmi ?kategori
      WHERE
          { 
              ?data
  			      info:name ?name;
              info:jk ?jk;
              info:usia ?usia;
              info:bb ?bb;
              info:tb ?tb;
              info:bmi ?bmi;
              info:kategori ?kategori;        
          }"
    );
  } else {
    $data = sparql_get(
      "http://ngrok:3030/dataBMI",
      "
      prefix info: <http://learningsparql.com/ns/addressbook#> 
      prefix data:  <http://learningsparql.com/ns/data#> 
      SELECT ?name ?jk ?usia ?bb ?tb ?bmi ?kategori
      WHERE
          { 
              ?data
  			      info:name ?name;
              info:jk ?jk;
              info:usia ?usia;
              info:bb ?bb;
              info:tb ?tb;
              info:bmi ?bmi;
              info:kategori ?kategori;        
          }
            "
    );
  }

  if (!isset($data)) {
    print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
  }

  ?>
      <header>
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search-data">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
      </nav>
    </header>
        
        <span>Cek BMI Disini!</span>
        <p>Body Mass Index (BMI) adalah pengukuran yang digunakan untuk menentukan golongan
          atau kategori berat badan.
          Website ini menampilkan data perorangan yang menentukan kategori berat badan berdasarkan standar BMI
        </p>
        <img src="/Users/ruthrebecca/Documents/kuliah/6/semweb/project-semweb/figma_htmlgenerator/images/image.png" alt="image"></img>
        <form class="d-flex" role="search" action="" method="post" id="search-data" name="search">
                    <input class="form-control me-2" type="search" placeholder="Ketik keyword disini" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <button class="button button1">View All</button>
                </form>
        <!-- <button class="button button1">View All</button> -->
        <!-- <button class="button button2">View Category</button> -->
      
      <div class="container">
        <?php
            if ($searchInput != NULL) {
                ?> 
                    <i class="fa-solid fa-magnifying-glass"></i><span>Menampilkan hasil pencarian untuk <b>"<?php echo $searchInput; ?>"</b></span> 
                <?php
            }
        ?>

        <table class="table table-bordered table-hover text-center table-responsive">
            <thead class="table-dark align-middle">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>BMI</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php $i = 0; ?>
                <?php foreach ($data as $data) : ?>
                    <td><?= ++$i ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['jk'] ?></td>
                    <td><?= $data['usia'] ?></td>
                    <td><?= $data['bb'] ?></td>
                    <td><?= $data['tb'] ?></td>
                    <td><?= $data['bmi'] ?></td>
                    <td><?= $data['kategori'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>

    </body>
</html>