<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['password']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Open Sans', sans-serif;
      display: flex;
      height: 100vh;
    }

    .container {
      display: flex;
      width: 100%;
    }

    .left-section {
      flex: 2;
      background: url('your-image.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      color: #ffffff;
      background-color: #063969;
    }

    .left-section h1 {
      font-size: 48px;
      font-weight: bold;
      text-transform: uppercase;
      border: 2px solid #fff;
      padding: 10px 20px;
    }

    .right-section {
      flex: 1;
      background-color: #7EC4EB;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .right-section h2 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .right-section p {
      font-size: 14px;
      color: #666;
      margin-bottom: 20px;
    }

    form {
      width: 100%;
      max-width: 300px;
    }

    .form-group {
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .btn-login {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      border: none;
      border-radius: 4px;
      color: white;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      box-sizing: border-box;
      text-transform: uppercase;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }

    .signup {
      font-size: 14px;
      margin-top: 15px;
      text-align: center;
    }

    .signup a {
      color: #007BFF;
      text-decoration: none;
    }

    .signup a:hover {
      text-decoration: underline;
    }

    /* Error message styling */
    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
    }
  .dinding {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: auto; /* Sesuaikan lebar gambar agar proporsional */
      z-index: 1; /* Pastikan gambar berada di belakang elemen lain */
  }

  .logo-kanan{
    width: 100px;;
    height: 100px;
  }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left Section -->
    <div class="left-section">
      <img src="img/logo_kaitokid.png" alt="">
      <img class="dinding" src="img/dinding.png" alt="">
    </div>

    <!-- Right Section -->
    <div class="right-section">
      <img class="logo-kanan" src="img/logo_kaitokid.png" alt="">
      <h1>LOGIN</h1>
      <?php
        // Menampilkan pesan error jika ada
        if (!empty($error)) {
          echo "<div class='error'>$error</div>";
        }
      ?>
      <p>Welcome back, please login to your account</p>

      <!-- Display error message if available -->

      <form action="#" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn-login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
<?php
}
?>