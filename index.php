<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top shadow-lg p-3 mb-5 bg-body-tertiary">
        <div class="container-md">
          <a href="#" class="navbar-brand">SOTEL</a>
          <div class="dropdown">
            <a href="#"
              class="d-flex align-items-center justify-content-center text-white text-decoration-none dropdown-toggle"
              id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4" style="margin-right:12px;"></i>
              <span class=" d-none d-sm-inline mx-1"><?= $_SESSION["nama"] ?> | <?= $_SESSION["roles"] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="margin-left:80px"
              aria-labelledby="dropdownUser1">
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
            <h2 class="text-center">DATA MAHASISWA</h2>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">+ Tambah Data</button>
          <!-- <a href="tambah.php">+ TAMBAH MAHASISWA</a> -->
          <br>
          <br>
          <table class="table align-middle table-hover table-bordered border-dark">
            <tr style="background-color: #ffab52" class="text-center">
              <th>NO</th>
              <th class="col-2">NAMA</th>
              <th class="col-1">NRP</th>
              <th>Jenis Kelamin</th>
              <th class="col-2">Jurusan</th>
              <th class="col-1">Email</th>
              <th class="col-2">Alamat</th>
              <th class="col-1">No HP</th>
              <th class="col-2">Asal SMA</th>
              <th class="col-1">Mata Kuliah Favorit</th>
              <th class="col-1">OPSI</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
            <tr class="table-bordered">
              <td><?= $no++; ?></td>
              <td><?= $row['nama']; ?></td>
              <td><?= $row['nrp']; ?></td>
              <td><?= $row['jenis_kelamin']; ?></td>
              <td><?= $row['jurusan']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['alamat']; ?></td>
              <td><?= $row['no_hp']; ?></td>
              <td><?= $row['asal_sma']; ?></td>
              <td><?= $row['matkul_fav']; ?></td>
              <td>
                <div class="d-flex justify-content-evenly">
                  <a href="edit.php?id= <?= $row['id']; ?>" style="margin-right:3px"><i
                      class="btn btn-warning text-white fa-solid fa-pen "></i></a>
                  <a href="hapus.php?id= <?= $row['id']; ?>"><i class="btn btn-danger text-white fa-solid fa-trash"
                      onclick="return confirm('yakin?')"></i></a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>


          <!---modal box tambah data-->
          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">TAMBAH DATA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="nama">Nama</label><br>
                        <input type="text" name="nama" class="form-control mb-2" required>
                        <label for="nrp">NRP</label><br>
                        <input type="text" name="nrp" class="form-control mb-2" required>
                        <label for="jurusan">Jurusan</label><br>
                        <input type="text" name="jurusan" id="" class="form-control mb-2" required>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="" class="form-control mb-2" required>
                        <label for="alamat">Alamat</label><br>
                        <input type="text" name="alamat" id="" class="form-control mb-2" required>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="jenis_kelamin">Jenis Kelamin</label><br>
                          <div class="form-check-inline mb-4">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki"
                              required>
                            <label class="form-check-label" for="flexRadioDefault1">Laki-laki</label>
                          </div>
                          <div class="form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                            <label class="form-check-label" for="flexRadioDefault2">Perempuan</label>
                          </div>
                        </div>
                        <label for="no_hp">No HP</label><br>
                        <input type="number" name="no_hp" id="" class="form-control mb-2" required>
                        <label for="asal_sma">Asal SMA</label><br>
                        <input type="text" name="asal_sma" id="" class="form-control mb-2" required>
                        <label for="matkul_fav">Matkul Favorit</label><br>
                        <input type="text" name="matkul_fav" id="" class="form-control mb-2" required>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>