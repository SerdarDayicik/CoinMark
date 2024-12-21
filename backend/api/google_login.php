<?php
// Google OAuth 2.0 istemci ID ve secret bilgilerini girin
$client_id = ''; // Google Developer Console'dan aldığınız client ID
$client_secret = ''; // Google Developer Console'dan aldığınız client secret
$redirect_uri = ''; // Google Callback URI

// OAuth 2.0 URL'si
$auth_url = 'https://accounts.google.com/o/oauth2/auth';
$scope = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';

// URL'yi oluşturun ve kullanıcıyı Google'a yönlendirin
$auth_url = $auth_url . "?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope";

header('Location: ' . $auth_url);  // Kullanıcıyı Google giriş sayfasına yönlendir
exit();
?>
