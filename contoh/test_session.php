<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        /* Reset Margin dan Padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container Utama */
        .container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 20px;
            gap: 20px; /* Beri jarak antar elemen */
        }

        /* Bagian Gambar */
        .image-container {
            flex: 1 1 40%; /* 40% untuk gambar */
            display: flex;
            justify-content: center;
        }

        .recipe-image {
            width: 100%;
            max-width: 400px; /* Maksimal ukuran foto */
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Bagian Konten */
        .content-container {
            flex: 1 1 55%; /* 55% untuk konten */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 10px;
        }

        /* Judul dan Deskripsi */
        .title {
            font-size: 24px;
            color: #FF8C42;
            margin-bottom: 8px;
        }

        .description {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }

        /* Tombol Navigasi */
        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Beri ruang antar tombol */
        }

        .nav-btn {
            background-color: #FF8C42;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .nav-btn:hover {
            background-color: #e07c31;
        }

        /* Media Query untuk Responsivitas */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-container,
            .content-container {
                flex: 1 1 100%;
            }

            .recipe-image {
                max-width: 100%;
            }

            .nav-btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Bagian Gambar -->
        <div class="image-container">
            <img src="../images/breakfast.jpg" alt="Foto Resep" class="recipe-image" />
        </div>

        <!-- Bagian Konten -->
        <div class="content-container">
            <h2 class="title">Ramen Sedap</h2>
            <p class="description">Ramen enak, kuah melimpah</p>

            <!-- Navigasi Simpan, Lihat, Bagikan, Unduh -->
            <div class="buttons-container">
                <button class="nav-btn">Simpan Resep</button>
                <button class="nav-btn">Lihat Resep</button>
                <button class="nav-btn">Bagikan Resep</button>
                <button class="nav-btn">Unduh Resep</button>
            </div>
        </div>
    </div>
</body>

</html>
