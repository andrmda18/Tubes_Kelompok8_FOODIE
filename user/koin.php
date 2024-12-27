<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koin dan Harga</title>
    <style>
        button {
            display: block;
            margin: 10px;
            padding: 20px;
            font-size: 16px;
            width: 200px;
            text-align: center;
            cursor: pointer;
        }
        button:hover {
            background-color: #f0f0f0;
        }
        .info {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .position-relative {
            position: relative;
            }

    </style>
</head>
<body>

    <h2>Pilih Jumlah Koin</h2>

    <!-- Tombol koin -->
    <button onclick="showInfo(50, 100)">50 Koin<br><span>Harga: Rp 100</span></button>
    <button onclick="showInfo(100, 200)">100 Koin<br><span>Harga: Rp 200</span></button>
    <button onclick="showInfo(150, 300)">150 Koin<br><span>Harga: Rp 300</span></button>
    <button onclick="showInfo(200, 400)">200 Koin<br><span>Harga: Rp 400</span></button>
    <button onclick="showInfo(250, 500)">250 Koin<br><span>Harga: Rp 500</span></button>
    <button onclick="showInfo(300, 600)">300 Koin<br><span>Harga: Rp 600</span></button>

    <!-- Menampilkan jumlah koin dan harga -->
    <div id="info" class="info"></div>

    <!-- Tombol Submit -->
    <form id="submitForm" method="POST" action="proses.php">
        <input type="hidden" id="hiddenKoin" name="koin" value="">
        <input type="hidden" id="hiddenHarga" name="harga" value="">
        <button type="submit" id="submitBtn" style="display: none;">Lanjutkan</button>
    </form>


    <script>
        // Fungsi untuk menampilkan informasi dan menyimpan data
        function showInfo(koin, harga) {
            // Menampilkan jumlah koin dan harga
            document.getElementById('info').innerHTML = "Jumlah Koin: " + koin + "<br>Harga: Rp " + harga;
            
            // Menyimpan nilai koin dan harga ke dalam input tersembunyi
            document.getElementById('hiddenKoin').value = koin;
            document.getElementById('hiddenHarga').value = harga;
            
            // Menampilkan tombol submit
            document.getElementById('submitBtn').style.display = 'block';
        }
    </script>

</body>
</html>
