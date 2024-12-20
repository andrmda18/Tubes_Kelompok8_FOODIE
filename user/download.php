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
    $username = $row['username'];
    $NamaResep = $row['NamaResep'];
    $deskripsi = $row['Deskripsi'];
    $Durasi = $row['Durasi'];
    $Bahan = $row['Bahan'];
    $Langkah = $row['Langkah'];
    $foto = $row['foto']; // Path foto, misalnya 'uploads/image.jpg'
} else {
    die("Data tidak ditemukan");
}

require('../fpdf186/fpdf.php');

// Membuat objek fpdf
$pdf = new FPDF();
$pdf->AddPage();

// Menambahkan judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Ln(5);
$pdf->Cell(200, 5, 'Resep: '. $NamaResep, 0, 1, 'C');

// Menambahkan username
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(3);
$pdf->Cell(200, 10, 'Author: '. $username, 0, 1, 'C');

// Menambahkan gambar jika ada
if (!empty($foto)) {
    $foto = '../images/' . $foto; // Sesuaikan path folder
    if (file_exists($foto)) {
       // Tentukan lebar gambar (misalnya, 100 mm) dan hitung posisi x untuk menengahkannya
        $imageWidth = 100;
        $pageWidth = $pdf->GetPageWidth(); // Lebar halaman
        $xPosition = ($pageWidth - $imageWidth) / 2; // Posisi x agar gambar berada di tengah

        // Tampilkan gambar
        $pdf->Image($foto, $xPosition, $pdf->GetY(), $imageWidth); // Posisi x dihitung, posisi y adalah posisi saat ini
        $pdf->Ln(100); // Tambahkan jarak setelah gambar
    } else {
        echo "Gambar tidak ditemukan di lokasi: $foto";
        exit;
    }
} else {
    echo "Tidak ada gambar yang ditentukan.";
    exit;
}

// if (file_exists($foto)) {
//     echo "File ditemukan: $foto";
// } else {
//     echo "File tidak ditemukan: $foto";
//     echo "Path lengkap: " . realpath($foto);
// }
// exit;



// Menambahkan deskripsi
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $Deskripsi);

// Menambahkan durasi
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Durasi:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $Durasi);

// Menambahkan bahan
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Bahan-bahan:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$bahanList = explode(",", $Bahan); // Memisahkan berdasarkan koma
$bahanNumber = 1;
foreach ($bahanList as $bahan) {
    if (!empty(trim($bahan))) {
        $pdf->Cell(5); // Memberikan sedikit indentasi
        $pdf->Cell(0, 10, $bahanNumber++ . '. ' . trim($bahan), 0, 1); // Menambahkan angka saja
    }
}

// Menambahkan langkah
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Langkah-langkah:', 0, 1);
$pdf->SetFont('Arial', '', 12);

// Memecah string langkah menjadi array berdasarkan baris
$langkahList = explode("-", $Langkah);
$langkahNumber = 1;
foreach ($langkahList as $langkah) {
    if (!empty(trim($langkah))) {
        $pdf->Cell(5); // Memberikan sedikit indentasi
        $pdf->Cell(0, 10, $langkahNumber++ . '. ' . trim($langkah), 0, 1); // Menambahkan angka saja
    }
}

// Menyimpan file PDF sementara
$fileName = 'resep_' . strtolower(str_replace(' ', '_', $NamaResep)) . '.pdf';
$pdf->Output('F', $fileName);

// Mengatur header untuk mengunduh file PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($fileName));

// Membersihkan buffer output
ob_clean();
flush();

// Mengirim file PDF ke browser
readfile($fileName);

// Menghapus file sementara setelah diunduh
unlink($fileName);
exit;
?>
