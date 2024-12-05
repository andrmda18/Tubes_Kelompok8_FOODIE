<?php
include "../dbconfig.php";

if (isset($_POST['btnSimpan'])) {
    $nama = $_POST["NamaResep"];
    $deskripsi = $_POST["Deskripsi"];
    $bahan = $_POST["Bahan"];
    $langkah = $_POST["Langkah"];
    $durasi = $_POST["Durasi"];

    // Query untuk insert data ke database
    $sqlStatement = "INSERT INTO tambahresep (NamaResep, Deskripsi , Durasi, Bahan, Langkah) VALUES ('$nama', '$deskripsi' , '$durasi', '$bahan', '$langkah')";
    $query = mysqli_query($conn, $sqlStatement);

  // Jika berhasil menambahkan resep
  if ($query) {
      // Ambil IdResep yang baru dimasukkan
      $IdResep = mysqli_insert_id($conn);
      
      // Menyusun URL dengan query string IdResep
      $successMsg = "Resep berhasil ditambahkan!";
      header("Location: ../foto.php?IdResep=$IdResep&successMsg=" . urlencode($successMsg));

      echo "../foto.php?IdResep=$IdResep&successMsg=" . urlencode($successMsg);
      exit;

      exit(); // Hentikan eksekusi script setelah redirect
  } else {
      // Jika gagal menambahkan resep
      $errMsg = "Gagal menambahkan resep! " . mysqli_error($conn);
      echo $errMsg; // Tampilkan pesan error
  }


  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>Tambah Resep</h2>
  <form method="post">
    <input type="text" placeholder="Tambahkan Nama Resep..." name="NamaResep" maxlength="200" required> <br>
    <textarea placeholder="Tambahkan Deskripsi..." name="Deskripsi" maxlength="200" required></textarea><br>
    <textarea placeholder="Tambahkan Bahan-bahannya..." name="Bahan" maxlength="200" required></textarea> <br>
    <textarea placeholder="Tambahkan Langkah-langkahnya..." name="Langkah" maxlength="200" required></textarea> <br>
    <input type="text" placeholder="Tambahkan durasi" name="Durasi" required>
    <input class="submit" type="submit" name="btnSimpan">
  </form>

</body>
</html>
  
</html>

