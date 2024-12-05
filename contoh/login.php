<!DOCTYPE html>
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
      href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Satisfy&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row min-vh-100">
        <!-- Kolom Gambar di Kiri -->
        <div class="col-md-6 p-0">
          <img
            src="../images/GAMBAR1.png"
            alt="FOODIE"
            class="img-fluid full-height"
          />
        </div>

        <!-- Kolom Konten di Kanan -->
        <div
          class="col-md-6 d-flex align-items-center justify-content-center text-center"
        >
          <div class="form-section w-75">
            <img src="../images/LOGO.png" alt="FOODIE" class="img-fluid mb-3" style="max-width: 50%; height: auto;" />
            <h1 class="text-warning"><b>Welcome!</b></h1>
            <form action="autentikasi.php" method="post">
              <div class="mb-3">
                <input type="text" id="username" class="form-control custom-outline" placeholder="Username" required />
              </div>
              <div class="mb-3">
                <input type="password" id="kataSandi" class="form-control custom-outline" placeholder="Password" required />
              </div>
              <div class="text-start">
                <a href="lupakatasandi.html" class="text-primary">Lupa Kata Sandi?</a>
              </div>
              <p class="line-text-alternate my-4">ATAU</p>
              <button class="btn btn-outline-danger w-100 mb-3">
                <img src="../images/Google.png" alt="Google" class="me-2" style="width: 20px;" />
                Daftar dengan Google
              </button>
              <p class="text-primary">Belum punya akun? <a href="register.html" class="fw-bold text-decoration-none">Daftar</a></p>
              <button class="btn btn-primary w-100 rounded-pill" type="submit">MASUK</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
