<?php
session_start();
include "../dbconfig.php"; // Koneksi database

// Memastikan IdResep valid dan ada dalam URL
$IdResep = isset($_GET['IdResep']) ? intval($_GET['IdResep']) : 0;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil dari session
} else {
    // Tangani jika username tidak ada di session
    echo "Anda harus login terlebih dahulu.";
    exit();
}

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
        $user = $resep['username'];
        // echo $user;
    } else {
        echo "Resep tidak ditemukan.";
        exit(); // Menghentikan eksekusi jika resep tidak ditemukan
    }
} else {
    echo "ID Resep tidak valid.";
    exit();
}

if (isset($_SESSION['jumlahKoin']) && isset($_SESSION['username'])) {
    $jumlahKoin = $_SESSION['jumlahKoin'];  // Mengambil jumlah koin yang dipilih
    $idPenerima = $_SESSION['username'];    // Mengambil username penerima
    $tanggal = date('Y-m-d H:i:s');          // Menentukan tanggal transaksi
} else {
    echo "Data session tidak ditemukan.";
    exit();
}


// Proses pemberian gift tahap pertama (memilih jumlah koin)
if (isset($_POST['chooseGift'])) {
    $_SESSION['jumlahKoin'] = $_POST['jumlahKoin']; // Menyimpan jumlah koin yang dipilih
    $_SESSION['username'] = $_POST['username']; // ID penerima gift
}

// Proses pemberian gift tahap kedua (konfirmasi dan simpan di database)
if (isset($_POST['confirmGift'])) {
    $jumlahKoin = $_SESSION['jumlahKoin'];
    $idPenerima = $_SESSION['username'];

    // Simpan riwayat transaksi pemberian gift
    $tanggal = date('Y-m-d H:i:s');
    mysqli_query($conn, "INSERT INTO koin (username, status, jumlahtransaksi, tanggal, riwayat_transaksi, idTransaksi) 
                        VALUES ('$idPenerima', 'berhasi', '$jumlahKoin', '$tanggal', 'menerima gift, 0)");

    // Simpan riwayat penerimaan gift
    mysqli_query($conn, "INSERT INTO koin (username, status, jumlahtransaksi, tanggal, riwayat_transaksi, idTransaksi) 
                        VALUES ('$username', '$jumlahKoin', '$tanggal', 'menerima gift, 0)");

    // Hapus data session sementara
    unset($_SESSION['jumlahKoin']);
    unset($_SESSION['idPenerima']);

    echo "<script>alert('Gift berhasil diberikan!'); window.location='foto.php';</script>";
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
    <style>
        .rating i {
            font-size: 2rem;
            color: #000;
        }
        .coin {
            display: inline-block;
            margin: 0 10px;
            text-align: center;
        }
        .coin img {
            width: 50px;
            height: 50px;
        }
        .coin span {
            display: block;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .btn-custom {
            background-color: #f8e7c1;
            border: 1px solid #000;
            color: #000;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #f8e7c1;
            color: #000;
        }
    </style>
</head>
<body>
    <!-- Sidebar Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0 sidebar">
                <ul>
                    <li><img src="../images/LOGO.png" alt="logo" /></li>
                    <li><a href="../logout.php"><i class="bi bi-person-fill"></i></a></li>
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
                        <img src="../images/<?= htmlspecialchars($foto) ?>" alt="Foto Resep" class="recipe-image" />
                    <!-- Konten Resep -->
                    <div class="content">
                        <!-- Navigasi Edit dan Delete -->
                        <div class="container">
                            <?php if ($resep['username'] == $_SESSION['username']):
                                ?>
                                <button class="dots" onclick="toggleMenu()">⋮</button>
                                <div class="menu" id="menu">
                                    <ul>
                                        <li>
                                            <a href="editresep.php?IdResep=<?= $resep['IdResep']; ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a href="deleteresep.php?IdResep=<?= $resep['IdResep']; ?>" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
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
                <div id=more>
                    <p><strong>Durasi:</strong> <?= $durasi ?></p>
                    
                    <p><strong>Bahan:</strong> 
                    <?php 
                    $array = explode(',', $bahan);
                    echo "<ul>";
                    foreach ($array as $bahan){
                        echo "<li>". htmlspecialchars($bahan). "</li>";
                    };
                    echo "</ul>";
                    ?>
                    </p>
                   
                    <p><strong>Langkah:</strong>
                    <?php 
                    $array2 = array_filter(explode('-', $langkah), 'strlen'); // Menghapus elemen kosong
                    echo "<ol>";
                    foreach ($array2 as $step) {
                        echo "<li>" . htmlspecialchars(trim($step)) . "</li>";
                    }
                    echo "</ol>";
                    ?>
                    </p>
                </div>
                <div class="card text-center">
                    <h5>
                        Yuk foodies, kasih support untuk resep ini
                    </h5>
                    <p>
                        Nominal cepat
                    </p>
                    <form method="POST">
                        <div class="d-flex justify-content-center">
                            <div class="coin">
                                <img alt="Coin icon" height="50" src="../images/Koin.png" width="50"/>
                                <span>10</span>
                                <input type="radio" name="jumlahKoin" value="10" required>
                            </div>
                            <div class="coin">
                                <img alt="Coin icon" height="50" src="../images/Koin.png" width="50"/>
                                <span>50</span>
                                <input type="radio" name="jumlahKoin" value="50" required>
                            </div>
                            <div class="coin">
                                <img alt="Coin icon" height="50" src="../images/Koin.png" width="50"/>
                                <span>100</span>
                                <input type="radio" name="jumlahKoin" value="100" required>
                            </div>
                        </div>

                        <input type="hidden" name="idPenerima" value="1"> <!-- ID penerima, misalnya diambil dari input hidden atau data lain -->

                        <button type="submit" class="btn btn-custom mt-3" name="giveGift">
                            Berikan Gift
                        </button>
                    </form>
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
