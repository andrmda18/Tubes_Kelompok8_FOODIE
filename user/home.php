<?php
session_start();
include "../dbconfig.php";

$sqlStatment = "
    SELECT t.IdResep, t.NamaResep, t.Deskripsi, t.foto, l.username, l.foto as poto
    FROM tambahresep as t
    INNER JOIN login as l
    ON t.username = l.username
    WHERE t.keterangan = 'Disetujui'
    ORDER BY t.IdResep DESC"; // Urutkan berdasarkan id terbaru
$query = mysqli_query($conn, $sqlStatment);

$sqlQuery = "SELECT * FROM kategori WHERE idKategori != 0";
$sql = mysqli_query($conn, $sqlQuery);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="home.css" />
    <link
      rel="stylesheet"
      href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- sidebar start -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 p-0 sidebar">
          <ul>
            <!-- <li><img src="../images/LOGO.png" alt="logo" /></li> -->
            <li>
              <a href="../logout.php"><i class="bi bi-person-fill"></i>Profil</a>
            </li>
            <li>
              <a href="home.php"><i class="bi bi-house-door-fill"></i>Beranda</a>
            </li>
            <li>
              <a href="indexdetail.php"
                ><i class="bi bi-people-fill"></i>Komunitas</a
              >
            </li>
            <li>
              <a href="#messages"
                ><i class="bi bi-chat-square-text-fill"></i>Pesan</a
              >
            </li>
            <li>
              <a href="#notification"
                ><i class="bi bi-bell-fill"></i>Pemberitahuan</a
              >
            </li>
            <li>
              <a href="#favorite"
                ><i class="bi bi-bookmark-heart-fill"></i>Favorit</a
              >
            </li>
            <li>
              <a href="#unduh"><i class="bi bi-download"></i>Unduh</a>
            </li>
            <li>
              <a href="uploadfoto.php"><i class="bi bi-plus-square-fill"></i>Posting</a>
            </li>
          </ul>
        </div>
        <!-- sidebar end -->

        <!-- main content start -->
        <div class="col-10 main-content">
          <div class="container p-5 pt-1">
            <!-- Logo Start -->
            <div class="text-center mb-3">
              <img src="../images/LOGO.png" alt="logo" width="15%" />
            </div>
            <!--  Logo End -->

            <!-- Search Start -->
            <div
              class="container-fluid d-flex align-items-center justify-content-center mb-3"
            >
              <a href="indexkoin.php" class="position-relative">
                <img src="../images/Koin.png" alt="" width="45px" class="me-2" />
                <!-- Angka koin di bawah ikon -->
                <span class="position-absolute bottom-0 start-50 translate-middle-x" style="font-size: 12px;">
                  100
                </span>
              </a>
              <form class="d-flex w-50">
                <div class="position-relative flex-grow-1">
                  <input
                    class="form-control"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                    style="padding-right: 35px"
                  />
                  <i
                    class="bi bi-search position-absolute"
                    style="
                      top: 50%;
                      right: 10px;
                      transform: translateY(-50%);
                      color: #7d7c7c;
                    "
                  ></i>
                </div>
                <button class="btn btn-outline-primary ms-2" type="submit">
                  Search
                </button>
              </form>
            </div>

            <!-- Search End -->

            <!-- Carousel Start -->
            <div id="carouselExampleIndicators" class="carousel slide">
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="../images/banner2.png"
                    class="d-block w-100"
                    style="height: 150px"
                    alt="Webinar "
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="../images/Banner.png"
                    class="d-block w-100"
                    style="height: 150px"
                    alt="Webinar "
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="../images/Banner.png"
                    class="d-block w-100"
                    style="height: 150px"
                    alt="Webinar "
                  />
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- carousel End -->
          </div>

          <!-- recomendaation start -->
          <section id="rekomendasi">
            <div class="row rekomendasi-section">
              <h3><b>Rekomendasi buat Foodies !</b></h3>
              <?php
              while ($row = $sql->fetch_assoc()) {
                echo '<div class="col-md-2">';
                echo '  <div class="rekomen">';
                echo '    <div class="card-rekomen">';
                echo '      <img src="../images/'.$row['foto'].'" alt="" class="card-img-top img-fluid"/>';
                echo '      <a href="foto.php?idKategori=' . $row['idKategori'] . '" class="custom-link"><p class="card-text"><b>'.$row['namaKategori'].'</b></p></a>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
              }
              ?>
            </div>
          </section>
          <!-- recomendation end -->

          <!-- postingan start -->
          <section id="postingan">
            <div class="row" style="margin-top: 5%">
              <?php
              while ($row = $query->fetch_assoc()) {
                echo '<div class="col-md-4 mb-3">';
                echo '<div class="card">';
                echo '  <div class="card-body">';
                echo '    <div class="d-flex justify-content-between align-items-center">';
                echo '       <div class="d-flex align-items-center gap-2">';
                echo '        <img src="../images/'.$row['poto'].'" class="circle-img" />'; // Jika ada gambar profil
                echo '        <span class="username">'.$row['username'].'</span>'; // Menampilkan username
                echo '       </div>';
                echo '       <span class="extra-text">1 foodiespict</span>';
                echo '    </div>';
                echo '    <div class="card-img-container">';
                echo '      <img src="../images/'.$row['foto'].'" alt="" class="card-img-top img-fluid" />'; // Gambar
                echo '    </div>';
                echo '      <a href="foto.php?IdResep=' . $row['IdResep'] . '" class="custom-link"><h5 class="fw-bold mb-0">' . $row['NamaResep'] . '</h5></a>';
                echo '    <p style="font-size: 14px">'.$row['Deskripsi'].'</p>';
                echo '  </div>';
                echo '</div>';
                echo '</div>';
              }
              ?>
            </div>
          </section>
          <!-- postingan end -->

          <!-- footer start -->
          <footer id="contact" class="custom-footer py-4">
            <div class="container text-center">
              <div class="row">
                <!-- Kontak -->
                <p class="col-md-6 mb-2 text-dark">
                  Contact Us:
                  <a
                    href="mailto:info@datasciencewebinar.com"
                    class="custom-footer"
                  >
                    <i class="bi bi-envelope"></i> foodie08@gmail.com
                  </a>
                </p>

                <!-- Media Sosial -->
                <p class="col-md-6 mb-2 text-dark">
                  Follow us on:
                  <a href="https://linkedin.com" class="custom-footer">
                    <i class="bi bi-linkedin"></i> LinkedIn
                  </a>
                  |
                  <a href="https://twitter.com" class="custom-footer">
                    <i class="bi bi-twitter"></i> Twitter
                  </a>
                  |
                  <a href="https://youtube.com" class="custom-footer">
                    <i class="bi bi-youtube"></i> YouTube
                  </a>
                </p>
              </div>
              <!-- Hak Cipta -->
              <p class="mt-3 text-dark">
                © 2024 Foodie. All Rights Reserved.
              </p>
            </div>
          </footer>

          <!-- footer end -->
        </div>
        <!-- Main Content End -->
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
