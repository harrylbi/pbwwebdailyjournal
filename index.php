<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Daily Journal</title>
    <style>
        .dark-theme {
            background-color: #3b3b3b;
            color: rgb(255, 255, 255);
        }
        .dark-theme .card {
            background-color: #aaeafa;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: rgb(40, 151, 151);">
        <div class="container">
            <a class="navbar-brand fw-bold">Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="article.html">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
                </ul>
                <div class="d-flex">
                    <button id="darkMode" class="btn btn-secondary m-2"><i class="bi bi-moon-stars-fill"></i></button>
                    <button id="lightMode" class="btn btn-info m-2"><i class="bi bi-sun-fill"></i></button>
                </div>
            </div>
        </div>
    </nav>
    <!---Navbar end-->

    <!-- Hero Section -->
    <div class="hero py-4">
        <div class="container d-flex align-items-center">
            <img src="img/jh78.jpeg" class="img-fluid me-4" width="300" alt="profil">
            <div>
                <h1 class="fw-bold">Welcome to my journal</h1>
                <h4 class="lead">Lihat beberapa journal dan foto</h4>
                <h6><span id="tanggal"></span> <span id="jam"></span></h6>
            </div>
        </div>
    </div>
    <!---Hero end-->
    
    <!-- article begin -->
    <section id="article" class="text-center p-5">
      <div class="container">
      <h1 class="fw-bold display-4 pb-3">ARTICLE</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM articles ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){
        ?>
          <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"]?></h5>
                <p class="card-text">
                  <?= $row["isi"]?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"]?>
                </small>
              </div>
            </div>
          </div>
          <?php
        }
        ?> 
      </div>
    </div>
  </section>
    <!---Article end-->

    <!--Gallery--->
    <div class="justify-content-center me-0 mt-0 mb-0 p-0">
        <section gallery id="carouselExampleIndicators" class="carousel slide">
          <h5 class=" fw-bold text-center display-4">GALLERY</h5>
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/wn2.jpg" class="custom-carousel-img mx-auto d-block w-90" alt="dk">
            </div>
            <div class="carousel-item">
              <img src="img/jh1.jpg" class="custom-carousel-img mx-auto d-block w-90" alt="hannie">
            </div>
            <div class="carousel-item">
              <img src="img/jun1.jpg" class="custom-carousel-img mx-auto d-block w-90" alt="jun">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </section gallery>
        <br>
      </div>
      <!--Gallery End-->

    <!---Footer--->
    <div class="container">
      <div class="d-flex flex-column align-items-center text-center h2 p-2 text-dark">
        <div class="d-flex justify-content-center">
          <a href="https://www.instagram.com/fbrnhae/profilecard/?igsh=NzdtMmswaTgxMDFy" class="btn btn-light m-2">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="mailto:111202315039@mhs.dinus.ac.id" class="btn btn-light m-2">
            <i class="bi bi-envelope-at"></i>
          </a>
          <a href="https://pin.it/5O3SRVu1Q" class="btn btn-light m-2">
            <i class="bi bi-pinterest"></i>
          </a>
          <a href="https://github.com/meganfbr" class="btn btn-light m-2">
            <i class="bi bi-github"></i>
          </a>
        </div>
        <div>
          <h6>credit by @meganfbr</h6>
        </div>
      </div>
    </div>
    <!----Footer End-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menampilkan waktu
        function tampilWaktu() {
            const waktu = new Date();
            const bulan = waktu.getMonth() + 1;
            document.getElementById("tanggal").textContent = `${waktu.getDate()}/${bulan}/${waktu.getFullYear()}`;
            document.getElementById("jam").textContent = `${waktu.getHours()}:${waktu.getMinutes()}:${waktu.getSeconds()}`;
            setTimeout(tampilWaktu, 1000);
        }
        tampilWaktu();

        // Tema gelap
        document.getElementById("darkMode").addEventListener("click", () => {
            document.body.classList.add("dark-theme");
        });

        //  Tema terang
        document.getElementById("lightMode").addEventListener("click", () => {
            document.body.classList.remove("dark-theme");
        });
    </script>
</body>
</html>
