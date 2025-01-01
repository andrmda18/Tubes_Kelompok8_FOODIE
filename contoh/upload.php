<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Penarikan Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .withdrawal-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-title {
            margin-bottom: 20px;
            text-align: center;
        }
        .coin-balance {
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="withdrawal-form">
            <h2 class="form-title">Penarikan Koin</h2>
            <div class="coin-balance">
                Jumlah Koin Anda: <span id="coinBalance">10,000</span> koin
            </div>
            <form>
                <div class="mb-3">
                    <label for="coinAmount" class="form-label">Jumlah Koin</label>
                    <input type="number" class="form-control" id="coinAmount" placeholder="Masukkan jumlah koin yang ingin ditarik">
                </div>
                <div class="mb-3">
                    <label for="walletAddress" class="form-label">Alamat Dompet</label>
                    <input type="text" class="form-control" id="walletAddress" placeholder="Masukkan alamat dompet Anda">
                </div>
                <div class="mb-3">
                    <label for="withdrawalMethod" class="form-label">Metode Penarikan</label>
                    <select class="form-select" id="withdrawalMethod">
                        <option selected>Pilih metode penarikan</option>
                        <option value="bank">Transfer Bank</option>
                        <option value="paypal">PayPal</option>
                        <option value="crypto">Cryptocurrency</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom w-100">Tarik Koin</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>