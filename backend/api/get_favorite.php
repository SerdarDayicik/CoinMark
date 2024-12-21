<?php
session_start();
require '../connect.php';

header('Content-Type: application/json');

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['google_id']) && !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Oturum açmanız gerekiyor.']);
    exit();
}


$user_id = $_SESSION['google_id'] ?? $_SESSION['user_id'];


try {
    // Item zaten favorilere eklenmiş mi kontrol et
    $varMı = $db->prepare("SELECT * FROM favorites WHERE user_id = ?");
    $varMı->execute([$user_id]);

    if ($varMı->rowCount() > 0) {
        // Yeni favori ekleme
        $sorgu = $db->prepare("SELECT * FROM favorites WHERE user_id = ?");
        $ekleme = $sorgu->execute([$user_id]);
        $favorites = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        if ($favorites) {
            $item_ids = array_column($favorites, 'name');
            echo json_encode(['success' => true, 'favorites' => $item_ids]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Favori bulunamadı.']);
        }
    } else {

    }
} catch (Exception $e) {
    // Hata mesajını loglama ve JSON yanıtı döndürme
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => "Bir hata oluştu, lütfen tekrar deneyin. $user_id"]);
}

?>