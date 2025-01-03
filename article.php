<?php
// Pastikan file ini ada dan tidak menyebabkan error

// Periksa apakah tombol simpan sudah diklik
if (isset($_POST['simpan'])) {
    // Ambil inputan form
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';  // Variabel gambar yang diinisialisasi kosong
    $nama_gambar = $_FILES['gambar']['name'];
    
    // Proses upload gambar jika ada file yang diupload
    if ($nama_gambar != '') {
        // Validasi tipe gambar
        $target_dir = "img/";
        $target_file = $target_dir . basename($nama_gambar);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Pastikan file yang diupload adalah gambar
        if (getimagesize($_FILES["gambar"]["tmp_name"]) !== false) {
            // Validasi ukuran file (opsional)
            if ($_FILES["gambar"]["size"] > 500000) {
                echo "<script>alert('Sorry, your file is too large.');</script>";
            } else {
                // Cek format file gambar yang diizinkan
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                } else {
                    // Pindahkan gambar ke server
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        $gambar = basename($_FILES["gambar"]["name"]);
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                    }
                }
            }
        } else {
            echo "<script>alert('File is not an image.');</script>";
        }
    }
    
    // Periksa apakah ada ID yang dikirimkan untuk update
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            // Jika tidak mengganti gambar, gunakan gambar lama
            $gambar = $_POST['gambar_lama'];
        } else {
            // Jika mengganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        // Query untuk update data
        $stmt = $conn->prepare("UPDATE articles 
                                SET judul = ?, isi = ?, gambar = ?, tanggal = ?, username = ? 
                                WHERE id = ?");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
        
        // Eksekusi query dan cek apakah berhasil
        $simpan = $stmt->execute();
    } else {
        // Jika tidak ada ID, insert data baru
        $stmt = $conn->prepare("INSERT INTO articles (judul, isi, gambar, tanggal, username) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
        
        // Eksekusi query dan cek apakah berhasil
        $simpan = $stmt->execute();
    }

    // Tampilkan pesan sukses atau gagal
    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}


// Jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        // Hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM articles WHERE id =?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>

    <div class="row">
        <div class="table-responsive" id="article_data">
        </div>
            <!-- Awal Modal Tambah-->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                                </div>
                                <div class="mb-3">
                                    <label for="floatingTextarea2">Isi</label>
                                    <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah-->


    </div>
</div>

<script>
    $(document).ready(function() {
        load_data();

        function load_data(hlm) {
            $.ajax({
                url: "article_data.php",
                method: "POST",
                data: {
                    hlm: hlm
                },
                success: function(data) {
                    $('#article_data').html(data);
                }
            })
        }

        $(document).on('click', '.halaman', function() {
            var hlm = $(this).attr("id");
            load_data(hlm);
        });
    });
</script>
