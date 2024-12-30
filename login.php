<?php
// Memulai atau melanjutkan session yang ada
session_start();

// Menyertakan kode dari file koneksi
include "koneksi.php";



// Memproses data jika form dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['user']);
  $password = trim($_POST['pass']);

  $password = md5($_POST['pass']);

  // Menggunakan prepared statement untuk menghindari SQL Injection
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password); // Binding parameter
  $stmt->execute(); // Menjalankan statement
  $hasil = $stmt->get_result(); // Menyimpan hasil
  $row = $hasil->fetch_array(MYSQLI_ASSOC); // Mengambil baris hasil

  // Memeriksa apakah user ditemukan
  if (!empty($row)) {
    // Jika ditemukan, simpan username di session
    $_SESSION['username'] = $row['username'];
    header("location:admin.php"); // Arahkan ke halaman admin
    exit();
  } else {
    // Jika tidak ditemukan, arahkan kembali ke halaman login dengan pesan error
    $error = "Username atau password salah!";
  }

  $stmt->close(); // Menutup statement
  $conn->close(); // Menutup koneksi
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
    }
    .login-container h2 {
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .form-group input:focus {
      border-color: #007BFF;
      outline: none;
    }
    .btn {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      border: none;
      border-radius: 4px;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    .error {
      color: red;
      font-size: 0.875em;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php
    // Menampilkan pesan error jika ada
    if (!empty($error)) {
      echo "<div class='error'>$error</div>";
    }
    ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="user">Username</label>
        <input type="text" id="user" name="user" required>
      </div>
      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" required>
      </div>
      <button class="btn" type="submit">Login</button>
    </form>
  </div>
</body>
</html>

