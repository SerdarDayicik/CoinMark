<?php

require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Boş kontrolü
    if (empty($username) || empty($password)) {
        echo "<p style='color: red;'>Kullanıcı adı ve şifre alanları boş bırakılamaz!</p>";
    } else {
        // Kullanıcı adının var olup olmadığını kontrol et
        $varMı = $db->prepare("SELECT * FROM user WHERE username = ?");
        $varMı->execute([$username]);

        if ($varMı->rowCount() == 1) {
            echo "<p style='color: red;'>Bu kullanıcı adı zaten kullanılmaktadır...</p>";
        } else {
            // Şifreyi güvenli bir şekilde hashle
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Yeni kullanıcıyı veritabanına ekle
            $sorgu = $db->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
            $ekleme = $sorgu->execute([$username, $hashed_password]);

            if (!$ekleme) {
                echo "<p style='color: red;'>Bir hata oluştu, ana sayfaya yönlendiriliyorsunuz...</p>";
                header("Refresh:5; url=http://localhost/WebProje/src/login.php");
            } else {
                echo "<p style='color: green;'>Kayıt başarılı, ana sayfaya yönlendiriliyorsunuz...</p>";
                header("Refresh:5; url=http://localhost/WebProje/src/login.php");
            }
        }
    }
}
?>
