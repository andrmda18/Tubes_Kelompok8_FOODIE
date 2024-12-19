<?php
include "../dbconfig.php";

// Memastikan IdResep valid dan ada dalam URL
$IdResep = isset($_GET['IdResep']) ? intval($_GET['IdResep']) : 0;

$sqlStatement = "SELECT * FROM tambahresep WHERE IdResep = $IdResep";
$query = mysqli_query($conn, $sqlStatement);

// Jika data ditemukan
if ($query->num_rows > 0) {
    // Ambil data resep dari database
    $row = $query->fetch_assoc();

    // Mengambil data resep
    $NamaResep = $row['NamaResep'];
    $deskripsi = $row['deskripsi'];
    $Durasi = $row['Durasi'];
    $Bahan = $row['Bahan'];
    $Langkah = $row['Langkah'];
    $foto = $row['foto'];
} else {
    // Jika tidak ada data, gunakan nilai default
    echo "Data tidak ditemukan";
}

require('../fpdf186/fpdf.php');

// membuat objek fpdf
$pdf = new FPDF();
$pdf->AddPage(); //membuat halaman baru

// menambahkan judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Resep: '. $NamaResep, 0, 1, 'C');

// // menambahkan nama pengguna
// $pdf->SetFont('Arial', 'I', 12);
// $pdf->Cell(200, 10, 'Nama Penulis: '. $namaPengguna, 0, 1, 'R');

// menambahkan deskripsi
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $deskripsi);

// menambahkan durasi
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $Durasi);

// menambahkan bahan
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Bahan-bahan:', 0, 1);
$pdf->MultiCell(0, 10, $Bahan);

// menambahkan langkah
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Langkah-langkah:', 0, 1);
$pdf->MultiCell(0, 10, $Langkah);

/// Menyimpan file PDF sementara
$fileName = 'resep_' . strtolower(str_replace(' ', '_', $NamaResep)) . '.pdf';
$pdf->Output('F', $fileName); // Menyimpan PDF ke file

// Mengatur header untuk mengunduh file PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($fileName));

// Mengirim file PDF ke browser
readfile($fileName);

// Menghapus file sementara setelah diunduh
unlink($fileName);

// Redirect setelah file berhasil diunduh
header('Location: unduhan.php?status=success');
exit;

?>