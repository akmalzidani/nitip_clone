<?php
require 'functions.php';

if (isset($_POST["register"])) {

  if (register($_POST) > 0) {
    echo "<script>
          alert('user baru berhasil ditambahkan');
        </script>";
    header(("Location: login.php"));
    exit;
  } else {
    echo mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Registration Form</title>
  <style>
  body {
    background-color: #555;
    color: #fff;
  }

  .card {
    background-color: #333;
    color: #fff;
  }

  .no-outline {
    border: none;
  }

  .form-label {
    color: #fff;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card" style="width:80%;">
          <div class="card-header p-3 text-center" style="background-color: #222;">
            <h4>REGISTRATION</h4>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="role" class="form-label" style="font-weight: 600;">Role</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-user-shield"
                      style="color: #ffffff;"></i></span>
                  <select class="form-select no-outline bg-dark text-white" id="role" name="role" required>
                    <option disabled selected>Pilih Role</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                  </select>
                </div>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label" style="font-weight: 600;">Username</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-user"
                      style="color: #ffffff;"></i></span>
                  <input type="text" class="form-control no-outline bg-dark text-white" id="username" name="username"
                    required>
                </div>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label" style="font-weight: 600;">Nama</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-user"
                      style="color: #ffffff;"></i></span>
                  <input type="text" class="form-control no-outline bg-dark text-white" id="name" name="nama" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label" style="font-weight: 600;">Password</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-lock"
                      style="color: #ffffff;"></i></span>
                  <input type="password" class="form-control no-outline bg-dark text-white" id="password"
                    name="password" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="password2" class="form-label" style="font-weight: 600;">Konfirmasi Password</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-lock"
                      style="color: #ffffff;"></i></span>
                  <input type="password" class="form-control no-outline bg-dark text-white" id="password2"
                    name="password2" required>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" name="register">Register</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-center">
            <p>Sudah punya akun? <a href="login.php" style="color:orange;">Login disini</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>