<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// cek redirect matkul
if (!isset($_GET['id'])) {
  header("Location: matkul.php");
  exit;
} else {
  $data = query("SELECT * FROM tugas_mhs WHERE id = '" . $_GET['id'] . "'");
  $datamhs = query("SELECT * FROM detail_tugas WHERE id_tugas = '" . $_GET['id'] . "'");
  $dataku = query("SELECT * FROM detail_tugas WHERE id_tugas = '" . $_GET['id'] . "' AND nama_mhs = '" . $_SESSION['nama'] . "'");
  $roleLevel = ($_SESSION['roles'] == 'Dosen') ? 2 : 1;

  // if role == mahasiswa
  // $dataku = query("SELECT * FROM detail_tugas WHERE id_tugas = '" . $_GET['id'] . "' AND nama_mhs = '" . $_SESSION['nama'] . "'");
  // if gak ketemu tampilkan form upload file
  // upload = insert file, namakita dll
  // kalo udah up, nama kita ketemu -> tampil tanda sudah submit
  // if nilai != -, tampilkan nilai
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
          <div class=" container pt-5">
            <div style="height:9vh"></div>
            <h2 class="text-center"><?= $_GET['tempe'] ?></h2>
          </div>
          <div class="row mx-2">
            <a href="matkul.php?tempe=<?= $_GET['tempe'] ?>" style="font-weight:700;text-decoration:none"><i
                class="bi bi-arrow-left" style="font-size:24px"></i>
              Kembali</a>
            <?php foreach ($data as $tugas) : ?>
            <div class="col-md-<?php echo ($roleLevel > 1) ? '12' : '8' ?>">
              <div class="my-4 box-shadow">
                <div class="card shadow p-4 ">
                  <h4><?= $tugas['nama'] ?></h4>
                  <hr>
                  <h6>Deskripsi</h6>
                  <p><?= $tugas['desc'] ?></p><br>

                  <?php if ($roleLevel == 1) : ?>
                  <h6>Keterangan</h6>
                  <?php
                      echo (!$dataku)

                        ? "<p style='color:red;'>Belum mengumpulkan</p>" : "<p style='color:green;'>Sudah mengumpulkan</p>";

                      ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php if ($roleLevel == 1) : ?>
            <div class="col-md-4 ?>">
              <div class="my-4 box-shadow">
                <?php if ($dataku['nilai'] != '-') : ?>
                <hr>
                <div class="bg-warning text-center rounded p-3">
                  <h6>NILAI ANDA</h6>
                  <h2 style="font-weight:700">96</h2>
                </div>
                <?php endif; ?>
                <div class="card shadow p-4">
                  <?php
                    echo (!$dataku)

                      ? "<h5 class='text-center' style='color:red;'>SEGERA KERJAKAN YA😠</h5>" : "<h5 class='text-center' style='color:green;'>MANTAP ANAK HEBAT😘</h5>";

                    ?>
                  <?php echo ($dataku['path'] == NULL) ? "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#tambah'>SUBMIT TUGAS</button>" : "<button type='button' class='btn btn-secondary' disabled>ANDA SUDAH MENGUMPULKAN</button>" ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <?php if ($roleLevel > 1) : ?>
          <div class=" container pt-3">
            <h4>Mahasiswa yang sudah submit</h4>
            <table class="table align-middle table-hover table-bordered border-dark">
              <tr style="background-color: #ffab52" class="text-center">
                <th>NO</th>
                <th>NAMA</th>
                <th>NILAI</th>
                <!-- if nilai == - = tampil form buat input nilai, else tampilkan nilai -->
                <th>OPSI</th>
              </tr>
              <?php $no = 1; ?>
              <?php foreach ($datamhs as $row) : ?>
              <tr class="table-bordered">
                <td><?= $no++; ?></td>
                <td><?= $row['nama_mhs']; ?></td>

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
          </div>
          <?php endif; ?>

          <!---modal box tambah data-->
          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
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
                        <label for="nama">Masukkan nama tugas : </label><br>
                        <input type="text" name="nama" class="form-control mb-2" required>
                        <input type="hidden" name="nama_matkul" value="<?= $_GET['tempe'] ?>">

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
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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