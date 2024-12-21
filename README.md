# CoinMark Projesi

CoinMark, kullanıcıların API'den çekilen 50 farklı kripto para birimini takip etmelerine olanak tanır. Giriş yapan kullanıcılar, favori coin'lerini ekleyip daha kolay bir şekilde takip edebilirler. Bu proje, kripto para yatırımcıları ve meraklıları için kullanımı basit bir takip aracıdır.

## Özellikler:
- **Google OAuth 2.0 ile giriş:** Kullanıcılar Google hesaplarıyla giriş yaparak uygulamayı kullanabilirler.
- **Favori Coin Takibi:** API üzerinden çekilen 50 kripto parayı görüntüleyebilir ve favori coin'lerini ekleyebilirler.
- **Basit Kullanıcı Arayüzü:** TailwindCSS ile şık ve modern bir tasarım.

## Başlangıç

### Gereksinimler
Proje üzerinde çalışmaya başlamadan önce aşağıdaki yazılımların kurulu olması gerekmektedir:
- [PHP](https://www.php.net/) (En az PHP 7.4)
- [Node.js ve npm](https://nodejs.org/) (Proje için TailwindCSS kullanıldığı için npm gereklidir)

### Kurulum

1. **Proje dosyasını indirin:**
   Projeyi GitHub üzerinden veya başka bir yöntemle bilgisayarınıza indirin.

2. **Google OAuth 2.0 Ayarları:**
   Projeyi çalıştırmadan önce, Google Developer Console'dan bir OAuth 2.0 istemci ID ve secret bilgisi almanız gerekmektedir. Bu bilgileri aşağıdaki dosyalarda girmeniz gerekecek:
   - `google_callback.php`
   - `google_login.php`

   Aşağıdaki yerleri doldurduğunuzdan emin olun:
   ```php
   $client_id = ''; // Google Developer Console'dan aldığınız client ID
   $client_secret = ''; // Google Developer Console'dan aldığınız client secret
   $redirect_uri = ''; // Google Callback URI

3. **TailwindCSS Kurulumu:** TailwindCSS'i kurmak için aşağıdaki adımları izleyin:
   - npm install
   - Bu komut, proje için gerekli olan tüm bağımlılıkları yükleyecektir.




### Kullanım
   - Projeyi başlatın: PHP sunucusunu başlatın ve tarayıcınızda projeyi görüntüleyin.
   - Giriş Yapın: Google OAuth 2.0 üzerinden giriş yaparak kullanıcı hesabınızı oluşturun.
   - Favori Coin'leri Takip Edin: API'den çekilen 50 coin arasından favorilerinizi seçin ve takip edin.



   

