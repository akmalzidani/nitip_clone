<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";
$mahasiswa = query("SELECT * FROM mahasiswa");

// cek redirect matkul
if (!isset($_GET['tempe'])) {
  header("Location: index_upl.php");
  exit;
} else {
  $data = query("SELECT * FROM tugas_mhs WHERE nama_matkul = '" . $_GET['tempe'] . "'");
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (tambah_tugas($_POST) > 0) {
    echo
    "<script>
    alert('data berhasil ditambahkan!');
    document.location.href = 'matkul.php';
    </script> ";
  } else {
    echo
    "<script>
    alert('data gagal ditambahkan!');
    document.location.href = 'matkul.php';
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
            <li>
              <a href="index_nilai.php" class="nav-link px-0 align-middle">
                <i class="fs-4 bi bi-pen"></i> <span class="ms-1 d-none d-sm-inline">Nilai</span> </a>
            </li>
          </ul>
          <hr>
        </div>
      </div>
      <div class="col py-3" style="margin-left:17%">
        <div class="container ">
          <div class=" container p-5">
            <div style="height:9vh"></div>
            <h2 class="text-center"><?= $_GET['tempe'] ?></h2>
          </div>
          <?php if ($_SESSION['roles'] == "Dosen") : ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">+ Tambah
              Tugas</button>
            <div class="row mx-2">
            <?php endif; ?>
            <?php foreach ($data as $tugas) : ?>
              <div class="col-md-12">
                <div class="my-4 box-shadow">
                  <div class="card shadow p-3 py-2">
                    <a href="detail_tgs.php?id=<?= $tugas['id'] ?>&tempe=<?= $_GET['tempe'] ?>">
                      <h4><?= $tugas['nama'] ?></h4>
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>


            </div>


            <!---modal box tambah data-->
            <div class=" modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">TAMBAH MATKUL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <input type="hidden" name="nama_matkul" value="<?= $_GET['tempe'] ?>">
                          <label for="nama">Masukkan nama tugas : </label><br>
                          <input type="text" name="nama" class="form-control mb-2" required>
                          <label for="desc">Deskripsi</label><br>
                          <textarea name="desc" id="desc" cols="60" rows="5"></textarea>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">TAMBAH</button>
                    </form>
                  </div>
                </div>
              </div>
              <!---END MODAL BOX TAMBAH DATA-->
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/bedc76568f.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>

<!-- namipilno semua Tugas

$tugas = select * where nama_tugas = $_get tempe

foreach ($tugas as $data){
    div card 
      $data->nama_tugas;
    /div 
}

id    nama          nama_matkul
1     queue         asd 
2     graph         asd 
3     undang-ud     kwn -->