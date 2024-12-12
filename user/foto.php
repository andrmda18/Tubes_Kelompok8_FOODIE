<?php
include "../dbconfig.php"; // Koneksi database

// Memastikan IdResep valid dan ada dalam URL
$IdResep = isset($_GET['IdResep']) ? intval($_GET['IdResep']) : 0;

if ($IdResep > 0) {
    $sqlStatement = "SELECT * FROM tambahresep WHERE IdResep = $IdResep";
    $query = mysqli_query($conn, $sqlStatement);

    if ($query && mysqli_num_rows($query) > 0) {
        $resep = mysqli_fetch_assoc($query);

        // Mengambil data resep
        $nama = $resep['NamaResep'];
        $deskripsi = $resep['Deskripsi'];
        $durasi = $resep['Durasi'];
        $bahan = $resep['Bahan'];
        $langkah = $resep['Langkah'];
        $foto = $resep['foto'];
    } else {
        echo "Resep tidak ditemukan.";
        exit(); // Menghentikan eksekusi jika resep tidak ditemukan
    }
} else {
    echo "ID Resep tidak valid.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="foto.css" />
    <link
      rel="stylesheet"
      href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
    <!-- Sidebar Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0 sidebar">
                <ul>
                    <li><img src="../images/LOGO.png" alt="logo" /></li>
                    <li><a href="#profile"><i class="bi bi-person-fill"></i></a></li>
                    <li><a href="home.php"><i class="bi bi-house-door-fill"></i></a></li>
                    <li><a href="#communities"><i class="bi bi-people-fill"></i></a></li>
                    <li><a href="#messages"><i class="bi bi-chat-square-text-fill"></i></a></li>
                    <li><a href="#notification"><i class="bi bi-bell-fill"></i></a></li>
                    <li><a href="#favorite"><i class="bi bi-bookmark-heart-fill"></i></a></li>
                    <li><a href="#download"><i class="bi bi-download"></i></a></li>
                    <li><a href="uploadfoto.php"><i class="bi bi-plus-square-fill"></i></a></li>
                </ul>
            </div>
            <!-- Sidebar End -->

            <!-- Main Content Start -->
            <div class="col main-content">
                <div class="container p-5">
                    <img src="../images/<?= htmlspecialchars($foto) ?>" alt="Foto Resep" width="50%" class="mb-3" />

                    <!-- Konten Resep -->
                    <div class="content">
                        <!-- Navigasi Edit dan Delete -->
                        <div class="container">
                            <!-- Letakkan ikon titik tiga dan menu di sini -->
                            <button class="dots" onclick="toggleMenu()">⋮</button>
                            <div class="menu" id="menu">
                            <ul>
                                <li><a href="editresep.php?IdResep=<?= $IdResep ?>">Edit</a></li>
                                <li><a href="deleteresep.php?IdResep=<?= $IdResep ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">Delete</a></li>
                            </ul>
                            </div>
                        </div>
                        <h3><?= $nama ?></h3>
                        <p><?= $deskripsi ?></p>


                        <!-- Navigasi Simpan Resep -->
                        <ul class="nav-resep">
                            <li><a href="#simpan" class="simpan-resep"><i class="bi bi-bookmark"></i>Simpan Resep</a></li>
                            <li><a href="#more" class="more"><i class="bi bi-search"></i>Lihat Resep</a></li>
                            <li><a href="share" class="share"><i class="bi bi-send"></i>Bagikan Resep</a></li>
                            <li><a href="download.php?IdResep=<?= $IdResep ?>" class="download"><i class="bi bi-download"></i>Unduh Resep</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Deskripsi, Durasi, Bahan, Langkah Resep -->
                <div>
                    <p><strong>Durasi:</strong> <?= $durasi ?></p>
                    <p><strong>Bahan:</strong> <?= $bahan ?></p>
                    <p><strong>Langkah:</strong> <?= $langkah ?></p>
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <script>
    function toggleMenu() {
      const menu = document.getElementById("menu");
      menu.style.display = menu.style.display === "block" ? "none" : "block";
    }

    // Menutup menu jika pengguna mengklik di luar menu
    document.addEventListener("click", function (event) {
      const menu = document.getElementById("menu");
      const dots = document.querySelector(".dots");
      if (menu && !menu.contains(event.target) && !dots.contains(event.target)) {
        menu.style.display = "none";
      }
    });
  </script>
</body>
</html>
