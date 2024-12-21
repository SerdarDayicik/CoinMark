<?php
session_start();
require '../connect.php';

header('Content-Type: application/json');

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['google_id']) && !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Oturum açmanız gerekiyor.']);
    exit();
}

// POST isteğinden gelen verileri al
$input = json_decode(file_get_contents('php://input'), true);
$namee = $input['name'] ?? null;

$user_id = $_SESSION['google_id'] ?? $_SESSION['user_id'];

if (!$namee == null && $namee == null) {
    echo json_encode(['success' => false, 'message' => "Geçerli bir item_id girin. "]);
    exit();
}

try {
    // Item zaten favorilere eklenmiş mi kontrol et
    $varMı = $db->prepare("SELECT * FROM favorites WHERE user_id = ? AND name = ?");
    $varMı->execute([$user_id, $namee]);

    if ($varMı->rowCount() > 0) {
        $sorgu = $db->prepare("DELETE FROM favorites WHERE user_id = ? AND name = ?");
        $ekleme = $sorgu->execute([$user_id, $namee]);  
        if (!$ekleme) {
            echo json_encode(['success' => false, 'message' => 'Favori Silinemedi.']);
        } else {
            echo json_encode(['success' => true, 'message' => "Favori Silindi."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Böyle bir kullanıcı bulunamadı. $user_id, $namee"]);
    }
} catch (Exception $e) {
    // Hata mesajını loglama ve JSON yanıtı döndürme
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Bir hata oluştu, lütfen tekrar deneyin.']);
}


?>