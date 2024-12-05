<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card Layout</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    .circle-img {
      width: 30px; /* Ukuran gambar profile lebih kecil */
      height: 30px;
      border-radius: 50%;
      object-fit: cover;
    }

    .username {
      font-weight: bold;
      font-size: 12px; /* Ukuran font username lebih kecil */
    }

    .card-body {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
      padding: 10px; /* Memberikan padding yang lebih kecil pada card */
    }

    .card h5 {
      margin-top: 8px; /* Mengurangi jarak atas pada judul card */
      font-size: 16px; /* Ukuran font judul card lebih kecil */
    }

    .card button {
      padding: 5px 8px;
      font-size: 12px; /* Ukuran font tombol lebih kecil */
    }

    .card-img-top {
      height: 150px; /* Membatasi tinggi gambar card */
      object-fit: cover; /* Memastikan gambar tetap sesuai proporsinya */
    }

    .card {
      width: 100%; /* Agar card tetap lebar penuh di dalam kolom */
      max-width: 200px; /* Membatasi ukuran maksimum card */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row pt-4">
      <h2 class="title-header">Home Request</h2>
    </div>
    <div class="row">
      <!-- Card 1 -->
      <div class="col-md-3 mb-4">
        <div class="card">
          <img
            src="../images/breakfast.jpg"
            alt="Image"
            class="card-img-top img-fluid"
          />
          <div class="card-body">
            <h5 class="fw-bold mb-2">Judul Resep</h5>
            <div class="d-flex align-items-center gap-2">
              <img src="../images/breakfast.jpg" class="circle-img" />
              <span class="username">Username</span>
            </div>
            <div class="d-flex justify-content-between gap-2 mt-3">
              <button class="btn btn-success btn-sm">Terima</button>
              <button class="btn btn-danger btn-sm">Tolak</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-3 mb-4">
        <div class="card">
          <img
            src="../images/breakfast.jpg"
            alt="Image"
            class="card-img-top img-fluid"
          />
          <div class="card-body">
            <h5 class="fw-bold mb-2">Judul Resep</h5>
            <div class="d-flex align-items-center gap-2">
              <img src="../images/breakfast.jpg" class="circle-img" />
              <span class="username">Username</span>
            </div>
            <div class="d-flex justify-content-between gap-2 mt-3">
              <button class="btn btn-success btn-sm">Terima</button>
              <button class="btn btn-danger btn-sm">Tolak</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-3 mb-4">
        <div class="card">
          <img
            src="../images/breakfast.jpg"
            alt="Image"
            class="card-img-top img-fluid"
          />
          <div class="card-body">
            <h5 class="fw-bold mb-2">Judul Resep</h5>
            <div class="d-flex align-items-center gap-2">
              <img src="../images/breakfast.jpg" class="circle-img" />
              <span class="username">Username</span>
            </div>
            <div class="d-flex justify-content-between gap-2 mt-3">
              <button class="btn btn-success btn-sm">Terima</button>
              <button class="btn btn-danger btn-sm">Tolak</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-3 mb-4">
        <div class="card">
          <img
            src="../images/breakfast.jpg"
            alt="Image"
            class="card-img-top img-fluid"
          />
          <div class="card-body">
            <h5 class="fw-bold mb-2">Judul Resep</h5>
            <div class="d-flex align-items-center gap-2">
              <img src="../images/breakfast.jpg" class="circle-img" />
              <span class="username">Username</span>
            </div>
            <div class="d-flex justify-content-between gap-2 mt-3">
              <button class="btn btn-success btn-sm">Terima</button>
              <button class="btn btn-danger btn-sm">Tolak</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
