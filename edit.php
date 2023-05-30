<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  if (ubah($_POST) > 0) {
    echo
    "<script>
    alert('data berhasil diupdate!');
    document.location.href = 'index.php';
    </script> ";
  } else {
    echo
    "<script>
    alert('data gagal diupdate!');
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
</head>

<body>
  <!---modal box update data-->
  <div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="p-3 card card-box rounded shadow">
      <h3 class="card-title text-center" id="exampleModalLongTitle">UPDATE DATA</h3>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <!-- mengambil ID data -->
              <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
              <label for="nama">Nama</label><br>
              <input type="text" name="nama" class="form-control mb-2" value="<?= $mhs["nama"]; ?>" required>
              <label for="nrp">NRP</label><br>
              <input type="text" name="nrp" class="form-control mb-2" value="<?= $mhs["nrp"]; ?>" required>
              <label for="jurusan">Jurusan</label><br>
              <input type="text" name="jurusan" id="" class="form-control mb-2" value="<?= $mhs["jurusan"]; ?>" required>
              <label for="email">Email</label><br>
              <input type="email" name="email" id="" class="form-control mb-2" value="<?= $mhs["email"]; ?>" required>
              <label for="alamat">Alamat</label><br>
              <input type="text" name="alamat" id="" class="form-control mb-2" value="<?= $mhs["alamat"]; ?>" required>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label><br>
                <div class="form-check-inline mb-4">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($mhs['jenis_kelamin'] == "Laki-laki") ? 'checked' : '' ?> required>
                  <label class="form-check-label" for="flexRadioDefault1">Laki-laki</label>
                  <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" <?= ($mhs['jenis_kelamin'] == "Perempuan") ? 'checked' : '' ?>>
                  <label class="form-check-label" for="flexRadioDefault2">Perempuan</label>
                </div>
              </div>
              <label for="no_hp">No HP</label><br>
              <input type="number" name="no_hp" id="" class="form-control mb-2" value="<?= $mhs["no_hp"]; ?>" required>
              <label for="asal_sma">Asal SMA</label><br>
              <input type="text" name="asal_sma" id="" class="form-control mb-2" value="<?= $mhs["asal_sma"]; ?>" required>
              <label for="matkul_fav">Matkul Favorit</label><br>
              <input type="text" name="matkul_fav" id="" class="form-control mb-2" value="<?= $mhs["matkul_fav"]; ?>" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
        <a href="index.php"><button class="btn btn-danger" name="submit">CANCEL</button></a>
        </form>
      </div>
    </div>
  </div>
  <!---END MODAL BOX update DATA-->
  <script src="https://kit.fontawesome.com/bedc76568f.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>