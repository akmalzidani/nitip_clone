<?php
session_start();
require 'functions.php';
//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}


if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}


if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {

    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      // set session
      $_SESSION["login"] = true;
      $_SESSION["nama"] = $row["nama"];
      $_SESSION['roles'] = $row["role"];
      // cek remember me
      if (isset($_POST['remember']) && $_POST["remember"] == "on") {
        // buat cookie
        setcookie('id', $row['id'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      header(("Location: home.php"));
      exit;
    }
  }

  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Login Form</title>
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
        <div class="card shadow-lg">
          <div class="card-header p-3 text-center" style="background-color: #222;">
            <h4>LOGIN</h4>
          </div>
          <div class="card-body">
            <?php if (isset($error)) : ?>
              <div class="p-2  rounded mb-2" style="background-color:#ffdddb; color:red;font-style:italic;">Login Gagal!
                Username/Password salah!
              </div>
            <?php endif; ?>

            <form action="" method="post">
              <div class="mb-3">
                <label for="username" class="form-label" style="font-weight: 600;">Username</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-user" style="color: #ffffff;"></i></span>
                  <input type="text" class="form-control bg-dark text-white no-outline" id="username" name="username" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label" style="font-weight: 600;">Password</label>
                <div class="input-group">
                  <span class="input-group-text no-outline bg-dark"><i class="fas fa-lock" style="color: #ffffff;"></i></span>
                  <input type="password" class="form-control bg-dark text-white no-outline" id="password" name="password" required>
                </div>
                <div class="input-group">
                  <input class="form-check" type="checkbox" name="remember" id="remember">
                  <label class="form-label p-2" for="remember">Remember me</label>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-center">
            <p>Belum punya akun? <a href="regis.php" style="color:orange;">Daftar disini</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>