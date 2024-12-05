<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login FOODIE</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="login.css" />
    <link
      rel="stylesheet"
      href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row min-vh-100">
        <!-- Kolom Gambar di Kiri -->
        <div class="col-md-6 p-0">
          <img
            src="images/GAMBAR1.png"
            alt="FOODIE"
            class="img-fluid full-height"
          />
        </div>

        <!-- Kolom Konten di Kanan -->
        <div
          class="col-md-6 d-flex align-items-center justify-content-center text-center"
        >
          <div class="form-section w-75">
            <img src="images/LOGO.png" alt="FOODIE" class="img-fluid mb-3" style="max-width: 30%; height: auto;" />
            <h1 style="color: #f09133;"><b>Welcome!</b></h1>
            <form method="POST" action="autentikasi.php">
              <div class="mb-3">
                <input type="text" id="username" name="username" class="form-control custom-outline" placeholder="Username" required>
              </div>
              <div class="mb-3">
                <input type="password" id="kataSandi" name="kataSandi" class="form-control custom-outline" placeholder="Password" required>
              </div>
              <div class="text-start">
                <a href="lupakatasandi.html" class="google-signup">Lupa Kata Sandi?</a>
              </div>
              <p class="line-text-alternate my-4">ATAU</p>
              <img src="images/Google.png" alt="google" width="8%" height="5%">
              <span class="google-signup"><a href="logingoogle.html">Daftar dengan Google</a></span>
              <p style="padding-top: 7px; color: #4472C4">Belum punya akun? <span class="google-signup"><a href="registrasi.php" class="google-signup"><strong>Daftar</strong></a></p></span>
              <div class="d-grid gap-2">
                <button class="btn btn-primary rounded-pill" name=btnSubmit type="submit">MASUK</button>
              </div> 
            </form>           
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>