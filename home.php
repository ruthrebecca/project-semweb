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
        $searchInput = "" ;
        $filter = "" ;
        
        if (isset($_POST['search'])) {
            $searchInput = $_POST['search'];
            $data = sparql_get(
            "http://localhost:3030/olin",
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
                    info:kategori ?kategori .
                    FILTER 
                        (regex (?name, '$searchInput', 'i'))
                }
            "
            );
        } else {
            $data = sparql_get(
            "http://localhost:3030/olin",
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
                    info:kategori ?kategori .
                    FILTER 
                        (regex (?name, '$searchInput', 'i'))
                }
            "
            );
        }

        if (!isset($data)) {
            print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
        }
    ?>
        <span>Cek BMI Disini!</span>
        <p>Body Mass Index (BMI) adalah pengukuran yang digunakan untuk menentukan golongan
          atau kategori berat badan.
          Website ini menampilkan data perorangan yang menentukan kategori berat badan berdasarkan standar BMI
        </p>
        <img src="/Users/ruthrebecca/Documents/kuliah/6/semweb/project-semweb/figma_htmlgenerator/images/image.png" alt="image"></img>
          
          <form class="d-flex" role="search" action="" method="post" id="search" name="search">
              <input class="form-control me-2" type="search" placeholder="Ketik keyword disini" aria-label="Search" name="search">
              <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
      </div>
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