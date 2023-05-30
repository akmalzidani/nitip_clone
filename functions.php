<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "akademik");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambah($data)
{
  global $conn;

  //ambil data dari tiap elemen dalam form
  $nama = htmlspecialchars($data["nama"]);
  $nrp = htmlspecialchars($data["nrp"]);
  $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $asal_sma = htmlspecialchars($data["asal_sma"]);
  $matkul_fav = htmlspecialchars($data["matkul_fav"]);

  // query insert data
  $query = "INSERT INTO mahasiswa VALUES ('','$nama','$nrp','$jenis_kelamin','$jurusan','$email','$alamat','$no_hp','$asal_sma','$matkul_fav')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function tambah_tugas($data)
{
  global $conn;

  //ambil data dari tiap elemen dalam form
  $nama_matkul = ($data['nama_matkul']);
  $nama = ($data["nama"]);
  $desc = ($data["desc"]);

  // query insert data
  $query = "INSERT INTO tugas_mhs VALUES ('','$nama','$nama_matkul','$desc')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}



function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  global $conn;

  //ambil data dari tiap elemen dalam form
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $nrp = htmlspecialchars($data["nrp"]);
  $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $asal_sma = htmlspecialchars($data["asal_sma"]);
  $matkul_fav = htmlspecialchars($data["matkul_fav"]);

  // query insert data
  $query = "UPDATE mahasiswa SET 
            nama = '$nama',
            nrp = '$nrp',
            jenis_kelamin = '$jenis_kelamin',
            jurusan = '$jurusan',
            email = '$email',
            alamat = '$alamat',
            no_hp = '$no_hp',
            asal_sma = '$asal_sma',
            matkul_fav = '$matkul_fav'
          WHERE id = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function register($data)
{
  global $conn;

  $role = $data["role"];
  $nama = $data["nama"];
  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  //cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
      alert('Konfirmasi password tidak sesuai');
    </script>";
    return false;
  }

  //cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
      alert('Username sudah terdaftar! Registrasi Gagal!');
    </script>";
    return false;
  }

  // encrypt password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
  mysqli_query($conn, "INSERT INTO users VALUES('', '$role', '$username', '$nama', '$password')");

  return mysqli_affected_rows($conn);
}