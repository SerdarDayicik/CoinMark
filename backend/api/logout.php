<?php
session_start();

if(isset($_SESSION['user_id']) || isset($_SESSION['google_id'])) {
    // Session temizlme
    session_unset();
    session_destroy(); 

    echo "<p style='color: green;'>Çıkış Başarılı Yönlendiriliyorsunuz</p>";
    header("Refresh:3; url=http://localhost/WebProje/src");
    exit;
    
}
else{
    echo "<p style='color: red;'>Buraya Erişemezsin</p>";
    header("Refresh:3; url=http://localhost/WebProje/src");
    exit;
}

?>