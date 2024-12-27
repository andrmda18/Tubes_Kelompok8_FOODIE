<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=test;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to top up coins
function topUpCoins($userId, $coins) {
    global $pdo;

    // Update user's coins
    $stmt = $pdo->prepare("UPDATE users SET coins = coins + :coins WHERE id = :id");
    $stmt->execute(['coins' => $coins, 'id' => $userId]);

    // Record the transaction
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount) VALUES (:user_id, 'top_up', :amount)");
    $stmt->execute(['user_id' => $userId, 'amount' => $coins]);

    return "Top-up berhasil: $coins koin ditambahkan.";
}

// Function to give feedback coins after eBook purchase
function giveFeedbackCoins($userId, $coins) {
    global $pdo;

    // Update user's coins
    $stmt = $pdo->prepare("UPDATE users SET coins = coins + :coins WHERE id = :id");
    $stmt->execute(['coins' => $coins, 'id' => $userId]);

    // Record the transaction
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount) VALUES (:user_id, 'purchase_feedback', :amount)");
    $stmt->execute(['user_id' => $userId, 'amount' => $coins]);

    return "Feedback berhasil: $coins koin diberikan.";
}

// Function to withdraw coins into balance
function withdrawCoins($userId, $coins) {
    global $pdo;

    // Check user's current coins
    $stmt = $pdo->prepare("SELECT coins FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    if (!$user || $user['coins'] < $coins) {
        return "Gagal mencairkan: Koin tidak mencukupi.";
    }

    // Calculate rupiah equivalent (1 coin = 100 rupiah, adjust as needed)
    $rupiah = $coins * 100;

    // Update user's coins and balance
    $stmt = $pdo->prepare("UPDATE users SET coins = coins - :coins, balance = balance + :balance WHERE id = :id");
    $stmt->execute(['coins' => $coins, 'balance' => $rupiah, 'id' => $userId]);

    // Record the transaction
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount) VALUES (:user_id, 'withdraw', :amount)");
    $stmt->execute(['user_id' => $userId, 'amount' => $rupiah]);

    return "Pencairan berhasil: $coins koin dicairkan menjadi Rp$rupiah.";
}

// Example usage
echo topUpCoins(1, 100); // Top-up 100 coins for user with ID 1
echo giveFeedbackCoins(1, 50); // Give 50 coins as feedback for user with ID 1
echo withdrawCoins(1, 100); // Withdraw 100 coins for user with ID 1
?>
