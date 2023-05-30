<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$mahasiswa = query("SELECT * FROM mahasiswa");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo
    "<script>
    alert('data berhasil ditambahkan!');
    document.location.href = 'index.php';
    </script> ";
  } else {
    echo
    "<script>
    alert('data gagal ditambahkan!');
    document.location.href = 'index.php';
    </script> ";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD PHP dan MySQLi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top shadow-lg p-3 mb-5 bg-body-tertiary">
        <div class="container-md">
          <a href="#" class="navbar-brand">SOTEL</a>
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center justify-content-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4" style="margin-right:12px;"></i>
              <span class=" d-none d-sm-inline mx-1"><?= $_SESSION["nama"] ?> | <?= $_SESSION["roles"] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="margin-left:80px" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="index.php">Data Mahasiswa</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item bg-danger" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark position-fixed">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
          <div style="height:9vh"></div>
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
              <a href="home.php" class="nav-link align-middle px-0">
                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
              </a>
            </li>
            <li>
              <a href="index_upl.php" class="nav-link px-0 align-middle">
                <i class="fs-4 bi bi-book-half"></i> <span class="ms-1 d-none d-sm-inline">Tugas</span> </a>
            </li>
            <?php if ($_SESSION['roles'] == 'Dosen') : ?>
              <li>
                <a href="index_nilai.php" class="nav-link px-0 align-middle">
                  <i class="fs-4 bi bi-pen"></i> <span class="ms-1 d-none d-sm-inline">Nilai</span> </a>
              </li>
            <?php endif; ?>
          </ul>
          <hr>
        </div>
      </div>
      <div class="col py-3" style="margin-left:17%;">
        <div style="height:6vh"></div>
        <div class="container ">
          <div class=" container p-5" style="height:89vh;">
            <h1 class="text-center" style="margin-top:25vh">Welcome,
              <span class="rounded px-2" style="background-color:#ffe44a;"><?= $_SESSION['nama'] ?><br></span>
            </h1>
            <h2 class="text-center">SOTEL E-Learning</h2>
          </div>



        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://kit.fontawesome.com/bedc76568f.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>