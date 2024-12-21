<?php
session_start(); // Session başlatma

// Navbar için session kontrolü
if (isset($_SESSION['user_id'])) {
    // Giriş yapmış kullanıcı
    $username = $_SESSION['username']; // Kullanıcı adı
}
elseif (isset($_SESSION['google_id'])) {
    $username = $_SESSION['google_username'];
    $google_profile_picture = $_SESSION['google_profile_picture'];
}
else {
    // Giriş yapmamış kullanıcı
    $username = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./output.css" rel="stylesheet">
    <title>WebProje</title>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .scale-in {
            animation: scaleIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-100px);
            transition: all 1s ease-out;
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(100px);
            transition: all 1s ease-out;
        }

        .slide-in-left.active, .slide-in-right.active {
            opacity: 1;
            transform: translateX(0);
        }
        .custom-bg {
        background: linear-gradient(to bottom, #010409 75%, #010409 85%, #00023A 98%);
        }
    </style>
</head>
<body class="custom-bg min-h-screen overflow-x-hidden">

    <!-- navbar -->
    <div class="sticky top-0 z-50 w-full transition-all duration-300 ease-in-out">
        <div class="flex justify-center w-full px-4 py-4">
            <nav class="flex items-center justify-between w-full max-w-7xl px-6 py-3 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-full shadow-md">
            <!-- {/* Left side - Logo and Brand */} -->
            <div class="flex items-center space-x-2">
                <a href="index.php">
                <span class="font-semibold text-3xl">
                    SerdarDyck
                </span>
                </a>
            </div>
            
                    <!-- {/* Middle - Navigation Links */} -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#About" class="text-lg text-gray-600 hover:text-gray-900">
                        About
                        </a>
                        <a href="coin_page.php" class="text-lg text-gray-600 hover:text-gray-900">
                        Markets
                        </a>
                        <?php if($username):?>
                            <a href="favori_page.php" class="text-lg text-gray-600 hover:text-gray-900">
                            Favori Coin
                            </a>
                        <?php endif;?>
                    </div>
            
            <?php if($username):?>
            <div class="flex items-center space-x-4">
                <!-- Dropdown için Button -->
                <div class="relative">
                    <button id="profile-dropdown" class="flex items-center space-x-2 bg-gray-100 text-gray-900 px-6 py-4 rounded-full hover:bg-gray-200 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                    </button>

                    <!-- Dropdown Menü -->
                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <div class="p-4">
                            <?php if(isset($google_profile_picture)):?>
                                <img src="<?php echo $google_profile_picture; ?>" width="10px" alt="profile_picture" class="rounded-full w-20 h-20 mx-auto">
                            <?php endif;?>
                            <p class="text-center text-lg mt-2"><?php echo $username; ?></p>
                        </div>
                        <div class="border-t border-gray-200">
                            <a href="../backend/api/logout.php" class="block px-6 py-3 text-gray-800 hover:bg-gray-300">Çıkış Yap</a>
                        </div>
                    </div>
                </div>
            </div>    
            <?php else:?>
            <!-- {/* Right side - Auth Buttons */} -->
            <div class="flex items-center space-x-4">
                <a href="registar.php" class="bg-[#1b1f24] text-white text-md px-6 py-3 rounded-full hover:bg-gray-800 transition-colors">
                Register
                </a>
                <a href="login.php" class="bg-gray-100 text-gray-900 text-md px-6 py-3 rounded-full hover:bg-gray-200 transition-colors">
                Login
                </a>
            </div>
            <?php endif;?>

            </nav>
        </div>
    </div>

    <!-- Main Page -->
    <div class="container mx-auto px-4 min-h-screen mt-32">
        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center text-center mt-16 space-y-12">
            <!-- Title -->
            <h1 class="text-6xl md:text-7xl font-bold tracking-tighter opacity-0 scale-in" id="title">
                <span class="text-white">CoinMark</span>
            </h1>

            <!-- Decorative Elements Container -->
            <div class="relative w-full h-64 my-8 opacity-0 scale-in" id="decorative-elements">
                <div class="absolute w-full h-full flex items-center justify-center opacity-75">
                    <img src="../public/btc.png" alt="" width="50px" height="50px" class="w-16 h-16 transform absolute left-1/3 float-animation" style="animation-delay: 0.5s;">
                    <img src="../public/eth.png" alt="" width="50px" height="50px" class="w-16 h-16 transform absolute float-animation" style="animation-delay: 0.8s;">
                    <img src="../public/usdc.png" alt="" width="50px" height="50px" class="w-16 h-16 transform absolute right-1/3 float-animation" style="animation-delay: 1s;">
                </div>
            </div>

            <!-- Description -->
            <p class="text-gray-200 text-xl max-w-3xl opacity-0 scale-in" id="description">
                Thanks for joining us at the world's fair of software, where AI, DevEx, and security took center stage. See you on Oct. 28-29, 2025.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-8 opacity-0 scale-in" id="buttons">
                <a href="coin_page.php" class="inline-flex items-center px-6 py-3 bg-white text-black rounded-full text-lg font-medium hover:bg-gray-800 transition-all hover:-translate-y-1">
                    GO MARKET
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="login.php" class="inline-flex items-center px-6 py-3 bg-white text-black rounded-full text-lg font-medium border border-gray-200 hover:bg-gray-50 transition-all hover:-translate-y-1">
                    LOGİN
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="min-h-screen flex items-center py-20" id="About">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Image -->
                <div class="slide-in-left transform rotate-45  float-animation" style="animation-delay: 0.7s;">
                    <img src="../public/1.jpg" alt="Developer Portrait" class="w-full max-w-lg mx-auto rounded-lg shadow-2xl">
                </div>

                <!-- Right Column - Content -->
                <div class="slide-in-right">
                    <h2 class="text-5xl font-bold mb-4 text-amber-400">About Us</h2>
                    <h3 class="text-2xl font-semibold mb-6 text-white">Developer & Designer</h3>
                    <p class="text-gray-300 mb-8 leading-relaxed">
                        I am a front-end web developer. I can provide clean code and pixel perfect design. 
                        I also make the website more & more interactive with web animations. I can provide clean 
                        code and pixel perfect design. I also make the website more & more interactive with web 
                        animations. A responsive design makes your website accessible to all users, regardless of their device.
                    </p>
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-amber-400 text-black rounded-full text-lg font-medium hover:bg-amber-500 transition-all hover:-translate-y-1">
                        Hire Me
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <footer class="mx-auto py-20"></footer>




    <!-- scrool animasion -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.slide-in-left, .slide-in-right').forEach((el) => {
                observer.observe(el);
            });
        });

        // Dropdown menüsünü açma/kapama işlemi
        const dropdownButton = document.getElementById('profile-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');
        
        dropdownButton.addEventListener('click', function(event) {
            dropdownMenu.classList.toggle('hidden'); // Menü açma/kapama
        });

        // Dropdown dışında bir yere tıklanırsa menüyü kapat
        window.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>