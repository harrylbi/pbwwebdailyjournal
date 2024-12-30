<?php
include "koneksi.php";  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Journal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">   

</head> 

<style>
    

.hero-section {
    background-color: #BFECFF;
    padding: 60px 0;
}

.hero-text h1 {
    font-size: 3rem;
    font-weight: bold;
}

.hero-text p {
    font-size: 1.5rem;
    margin-top: 10px;
}

.hero-img img {
    max-width: 100%;
    border-radius: 10px;
}

/* Ubah warna background navbar */
.custom-navbar {
    background-color: #CDC1FF; 
}

/* Efek hover pada item navbar */
.navbar-nav .nav-link:hover {
    background-color: #2d252a; 
    color: #F6F; 
}


.carousel-inner img {
    width: 100%; 
    height: 500px; 
    object-fit: cover; 
}

.footer {
    background-color: #FFCCEA;
}

body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}


.navbar-nav .nav-link.dark-mode {
    color: #ffffff; /* Warna teks pada navbar saat dark mode */
}

.custom-navbar .nav-link:hover.dark-mode {
    background-color: #333333; /* Warna latar belakang saat hover di dark mode */
}

.artikel.dark-mode {
    background-color: #1f1f1f;
    color: #d9cbcb; 
}


.btn-primary {
    background-color: #007bff;
}

.btn-primary.dark-mode {
    background-color: #0056b3;
}

.footer.dark-mode {
    background-color: #1f1f1f; 
    color: #ffffff; 
}
</style>


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

    <!-- Hero Section -->
<!-- Hero Section -->
<section id="hero-section">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-7 col-md-6 hero-text">
              <h1>Create Memories, Save Memories, Everyday</h1>
              <p>Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</p>
              <h6>
                  <span id="tanggal"></span>
                  <span id="jam"></span>
              </h6>
          </div>
          <div class="col-lg-5 col-md-6 hero-img p-5">
              <img src="img/haibara1.jpg" alt="Memory Image" class="img-fluid">
          </div>
      </div>
  </div>
</section>

    <!-- artikel -->
<!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM articles  ORDER BY tanggal DESC";
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
<!-- article end -->

    <section id="Gallery">
      
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/miwako1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
  
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/haibara3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/miwako4.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>    
    
      <section>
        <footer class="text-center p-3 row ">
        <div class="foot">
          <span>harry lbi @2023</span>
          <div>
            <a href="https://wa.me/nomor_telepon_anda" class="text-decoration-none text-dark ms-3">
                <i class="bi bi-whatsapp"></i>
            </a>
            <a href="https://instagram.com/username_anda" class="text-decoration-none text-dark ms-3">
                <i class="bi bi-instagram"></i>
            </a>  
            <a href="https://instagram.com/username_anda" class="text-decoration-none text-dark ms-3">
                <i class="bi bi-facebook"></i>
            </a>  
          </div>
        </div>
        </footer>
      </section>

    <script type="text/javascript">
      window.setTimeout("tampilkanWaktu()", 1000);
      function tampilkanWaktu() {
        var waktu = new Date();
        var h = waktu.getHours();
        var m = waktu.getMinutes();
        var s = waktu.getSeconds();

        setTimeout("tampilkan waktu()", 1000);
        document.getElementById("tanggal").innerHTML = waktu.getDate() + "/" + (waktu.getMonth() + 1) + "/" + waktu.getFullYear();
      }

    const toggleButton = document.getElementById('toggle-dark-mode');
    const body = document.body;

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.classList.toggle('dark-mode');
        });
        toggleButton.classList.toggle('btn-secondary');
        toggleButton.classList.toggle('btn-light');
        toggleButton.innerText = body.classList.contains('dark-mode') ? 'Light Mode' : 'Dark Mode';
    });
      
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
