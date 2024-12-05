<?php
include "../dbconfig.php"; // Koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simpan Resep</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="simpan.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Sidebar Start -->
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-1 p-0 sidebar">
          <ul class="nav flex-column text-center py-3">
            <li class="mb-4">
              <img src="../images/LOGO.png" alt="Logo" class="img-fluid" />
            </li>
            <li class="mb-3">
              <a href="#profile" class="text-light"><i class="bi bi-person-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#home" class="text-light"><i class="bi bi-house-door-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#communities" class="text-light"><i class="bi bi-people-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#messages" class="text-light"><i class="bi bi-chat-square-text-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#notification" class="text-light"><i class="bi bi-bell-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#favorite" class="text-light"><i class="bi bi-bookmark-heart-fill"></i></a>
            </li>
            <li class="mb-3">
              <a href="#download" class="text-light"><i class="bi bi-download"></i></a>
            </li>
            <li>
              <a href="#upload"><i class="bi bi-file-plus-fill"></i></a>
            </li>
          </ul>
        </div>
        <!-- Sidebar End -->

        <!-- Main Content -->
        <div class="col main-content">
          <!-- Header -->
          <header>
            <div class="container">
              <!-- Kolom dengan lebar 10 dari grid -->
              <div class="row">
                <!-- Membagi kolom menjadi 6 kolom untuk masing-masing header -->
                <div class="col-6">
                  <div class="header-container">
                    <div class="header-item" onclick="activateHeader(this)">
                      <span class="header-text"><i class="bi bi-bookmark"></i>Postingan</span>
                    </div>
                  </div>
                </div>
          
                <div class="col-6">
                  <div class="header-container">
                    <div class="header-item" onclick="activateHeader(this)">
                      <span class="header-text"><i class="bi bi-play"></i>Video</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </header>

          <!-- Grid Content -->
          <div class="container my-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
              <?php
              // Ambil data resep dari database
              $sql = "SELECT * FROM tambahresep";
              $query = mysqli_query($conn, $sql);

              while ($resep = mysqli_fetch_assoc($query)) {
              ?>
                <!-- Grid Item -->
                <div class="col">
                  <div class="card">
                    <div class="position-relative">
                      <img
                        src="../images/SH_frappuccino.jpg"
                        alt="Example 1"
                        class="card-img-top"
                      />
                      <i class="bi bi-play-circle-fill play-button"
                        ></i>
                      <span
                      >
                        <?= $resep["Durasi"] ?> menit
                      </span>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?= htmlspecialchars($resep["NamaResep"]) ?></h5>
                      <p class="card-text"><?= htmlspecialchars($resep["Deskripsi"]) ?></p>
                    </div>
                  </div>
                </div>
                <!-- Grid Item End -->
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <!-- Main Content End -->
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
  </body>
</html>
