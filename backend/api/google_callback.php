<?php
session_start();

require '../connect.php';

// Google OAuth 2.0 istemci ID ve secret bilgilerini girin
$client_id = ''; // Google Developer Console'dan aldığınız client ID
$client_secret = ''; // Google Developer Console'dan aldığınız client secret
$redirect_uri = ''; // Google Callback URI

// Google API'ye token almak için URL
$token_url = 'https://oauth2.googleapis.com/token';

// 1. Google'dan dönen code parametresini alıyoruz
$code = $_GET['code'] ?? '';

// 2. Code ile Google'a token isteği gönderiyoruz
if ($code) {
    $post_data = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
    ];

    // Token almak için POST isteği gönder
    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

    $response = curl_exec($ch);
    curl_close($ch);

    // JSON yanıtını alıyoruz
    $data = json_decode($response);

    // Access token'ı alıyoruz
    $access_token = $data->access_token;

    if ($access_token) {
        // 3. Access token ile kullanıcı bilgilerini alıyoruz
        $user_info_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_info_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $access_token
        ]);

        $user_info_response = curl_exec($ch);
        curl_close($ch);

        // JSON yanıtını alıyoruz
        $user_info = json_decode($user_info_response);
        // Kullanıcı bilgilerini alın
        $username = $user_info->name;
        $email = $user_info->email;
        $google_id = $user_info->id;
        $profile_picture = $user_info->picture;

        // Kullanıcıyı veritabanına kaydedebiliriz veya session ile giriş yapabiliriz
        // Kullanıcıyı session'a kaydediyoruz
        $_SESSION['google_id'] = $google_id;
        $_SESSION['google_username'] = $username;
        $_SESSION['google_email'] = $email;
        $_SESSION['google_profile_picture'] = $profile_picture;

        // Kullanıcı adının var olup olmadığını kontrol et
        $varMı = $db->prepare("SELECT * FROM user WHERE google_id = ?");
        $varMı->execute([$google_id]);
        
        if ($varMı->rowCount() == 1) {
            echo "<p style='color: green;'>Giriş Yapılıyor...</p>";
            header("Refresh:5; url=http://localhost/WebProje/src");
            exit();
        } 
        else {    
            // Yeni kullanıcıyı veritabanına ekle
            $sorgu = $db->prepare("INSERT INTO user (google_id, username) VALUES (?, ?)");
            $ekleme = $sorgu->execute([$google_id, $username]);
        
            if (!$ekleme) {
                echo "<p style='color: red;'>Bir hata oluştu, ana sayfaya yönlendiriliyorsunuz...</p>";
                header("Refresh:5; url=http://localhost/WebProje/src/login.php");
            } else {
                echo "<p style='color: green;'>Giriş Yapılıyor...</p>";
                header("Refresh:5; url=http://localhost/WebProje/src");
                exit();
            }           
        } 
    }
    else {
        echo "Google ile giriş yaparken bir hata oluştu.";
    }
} 
else {
    echo "Google'dan geri dönüşte bir sorun oldu.";

}
?>