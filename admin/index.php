<?php
include "../dbconfig.php";

$sqlStatment = "
    SELECT t.IdResep, t.NamaResep, t.Deskripsi, t.foto, l.username, l.foto as poto
    FROM tambahresep as t
    INNER JOIN login as l
    ON t.username = l.username
    WHERE t.keterangan IS NULL OR t.keterangan = ''
    ORDER BY t.IdResep DESC"; // Urutkan berdasarkan id terbaru
$query = mysqli_query($conn, $sqlStatment);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ACC ADMIN</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="index.css" />
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
        <div class="col-1 p-0 sidebar">
          <ul>
            <li><a href="../logout.php"><img src="../images/LOGO.png" alt="logo" /></li></a>
            <li><a href="tambahkategori.php"><i class="bi bi-collection"></i></a></li>
            <li><a href="index.php"><i class="bi bi-folder-check"></i></a></li>
            <li><a href="konfirmasitopup.php"><i class="bi bi-coin"></i></a></li>
            <li><a href="konfirmasitarik.php"><i class="bi bi-wallet2"></i></a></li>
          </ul>
        </div>
        <!-- sidebar end -->

        <!-- Main content -->
        <div class="col main-content">
          <div class="container">
            <div class="row pt-4">
              <h2 class="title-header">Home Request</h2>
            </div>
            <div class="row">
              <!-- Card 1 -->
              <?php
              while ($row = mysqli_fetch_assoc($query)) {
                  echo '<div class="col-md-2 mb-4">';
                  echo '  <div class="card">';
                  echo '    <img src="../images/' . htmlspecialchars($row['foto']) . '" alt="Resep Image" class="card-img-top img-fluid" />';
                  echo '    <div class="card-body">';
                  echo '        <h5 class="fw-bold mb-2">' . htmlspecialchars($row['NamaResep']) . '</h5>';
                  echo '        <div class="d-flex align-items-center gap-2">';
                  echo '            <img src="../images/' . htmlspecialchars($row['poto']) . '" alt="User Image" class="circle-img" />';
                  echo '            <span class="username">' . htmlspecialchars($row['username']) . '</span>';
                  echo '        </div>';
                  echo '        <div class="button-container mt-3">';
                  echo '            <form method="POST" action="proses_keterangan.php" style="display:inline;">';
                  echo '                <input type="hidden" name="idresep" value="' . htmlspecialchars($row['IdResep']) . '">';
                  echo '                <input type="hidden" name="keterangan" value="Disetujui">';
                  echo '                <button type="submit" class="btn btn-success btn-sm">Terima</button>';
                  echo '            </form>';
                  echo '            <form method="POST" action="proses_keterangan.php" style="display:inline;">';
                  echo '                <input type="hidden" name="idresep" value="' . htmlspecialchars($row['IdResep']) . '">';
                  echo '                <input type="hidden" name="keterangan" value="Ditolak">';
                  echo '                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>';
                  echo '            </form>';
                  echo '        </div>';
                  echo '    </div>';
                  echo '  </div>';
                  echo '</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
