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
            background-color:rgb(255, 255, 255);
        }
        .dark-theme .hero{
          background-color:rgb(54, 75, 83);
        }
        .dark-theme .gallery{
          background-color:rgb(54, 75, 83);
        }
        .card-img-top {
        width: 100%; /* Mengatur lebar gambar agar sesuai dengan lebar kartu */
        height: 300px; /* Mengatur tinggi gambar */
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
        }
        .custom-carousel-img {
        width: 50%; /* Mengatur lebar gambar agar sesuai dengan lebar carousel */
        height: 800px; /* Mengatur tinggi gambar */
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
      }
      .hero{
        background-color: rgb(172, 231, 231);
      }
      .gallery{
        background-color: rgb(172, 231, 231);
      }
      .footer{
        background-color: rgb(40, 151, 151);
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar sticky-top">
      <div class="container">
          <a class="navbar-brand" href="#">My Daily Journal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link " href="#hero-section">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#artikel">Article</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#Gallery">Gallery</a>
                  </li>
                  <li class="nav-item">
                      <button class="btn btn-secondary" id="toggle-dark-mode">Dark Mode</button>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
    <!---Navbar end-->

    <!-- Gallery -->
    <div class="gallery justify-content-center me-0 mt-0 mb-0 p-0">
        <section id="carouselExampleIndicators" class="carousel slide">
            <h5 class="fw-bold text-center display-4">GALLERY</h5>
            <div class="carousel-indicators">
                <?php
                // Ambil gambar dari database
                $sql = "SELECT gambar FROM articles";
                $hasil = $conn->query($sql);
                $totalImages = $hasil->num_rows; // Menghitung total gambar
                for ($i = 0; $i < $totalImages; $i++) {
                    echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . ($i === 0 ? 'active' : '') . '" aria-current="' . ($i === 0 ? 'true' : 'false') . '" aria-label="Slide ' . ($i + 1) . '"></button>';
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                $isActive = true; // Untuk menandai slide aktif
                while ($row = $hasil->fetch_assoc()) {
                    ?>
                    <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                        <img src="img/<?= $row['gambar'] ?>" class="custom-carousel-img mx-auto d-block w-90" alt="Gallery Image">
                    </div>
                    <?php
                    $isActive = false; // Set active ke false setelah slide pertama
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </section>
        <br>
    </div>
    <!-- Gallery End -->

    <!---Footer--->
    <div class="footer">
      <div class="d-flex flex-column align-items-center text-center h2 p-2 text-dark">
        <div class="d-flex justify-content-center">
          <a href="mailto:111202315332@mhs.dinus.ac.id" class="btn btn-light m-2">
            <i class="bi bi-envelope-at"></i>
          </a>
          <a href="https://github.com/harrylbi" class="btn btn-light m-2">
            <i class="bi bi-github"></i>
          </a>
        </div>
        <div>
          <h6>credit by @harrylbi</h6>
        </div>
      </div>
    </div>
    <!----Footer End-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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