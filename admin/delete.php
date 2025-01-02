<?php
include "../dbconfig.php";

// Check if the idKategori is set and is not empty
if (isset($_POST['idKategori']) && !empty($_POST['idKategori'])) {
    $idKategori = $_POST['idKategori'];

    // Prepare SQL query to delete the category
    $sqlDelete = "DELETE FROM kategori WHERE idKategori = '$idKategori'";

    if (mysqli_query($conn, $sqlDelete)) {
        // Redirect to the category page or show a success message
        header("Location: tambahkategori.php?message=Kategori berhasil dihapus!");
        exit;
    } else {
        // Error in deletion
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "idKategori tidak ditemukan!";
}
?>
