<?php
session_start();


if (isset($_SESSION['user_id']) || isset($_SESSION['google_id'])) {
    echo "<p style='color: red;'>Zaten Giriş Yaptınız...</p>";
    header("Refresh:3; url=http://localhost/WebProje/src");
    exit;
}

require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');


    // Boş kontroletme
    if (empty($username) || empty($password)) {
        echo "<p style='color: red;'>Kullanıcı adı ve şifre alanları boş bırakılamaz!</p>";
    } 
    else{
        $sorgu = $db->prepare("SELECT * FROM user WHERE username = ?");
        $sorgu->execute([$username]);

        if ($sorgu->rowCount() == 1) {
            $user = $sorgu->fetch(PDO::FETCH_ASSOC);

            // Şifreyi doğrula
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo "<p style='color: green;'>Giriş başarılı!</p>";
                header("Refresh:3; url=http://localhost/WebProje/src");
            } else {
                echo "<p style='color: red;'>böyle bir kullanıcı bulunmamaktadır</p>";
            }
        }else{
            echo "<p style='color: red;'>böyle bir kullanıcı bulunmamaktadır</p>";
        }
    }
}