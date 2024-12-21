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
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./output.css" rel="stylesheet">
    <style>
    .custom-bg {
        background: linear-gradient(to bottom, #010409 95%, #010409 97%, #00023A 100%);
    }
    </style>
</head>
<body>

<div class="min-h-screen custom-bg">
            <!-- navbar -->
        <div class="sticky top-0 z-50 w-full transition-all duration-300 ease-in-out">
            <div class="flex justify-center w-full px-4 py-4">
                <nav
                    class="flex items-center justify-between w-full max-w-7xl px-6 py-3 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-full shadow-md">
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
                        <a href="index.php#About" class="text-lg text-gray-600 hover:text-gray-900">
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
                            <div class="relative">
                                <button id="profile-dropdown" class="flex items-center space-x-2 bg-gray-100 text-gray-900 px-6 py-4 rounded-full hover:bg-gray-200 focus:outline-none">
                                    <i class="fa-solid fa-user"></i>
                                </button>
                            </div>

                            <!-- Dropdown Menü -->
                            <div id="dropdown-menu"
                                class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                <div class="p-4">
                                    <?php if(isset($google_profile_picture)):?>
                                    <img src="<?php echo $google_profile_picture; ?>" width="10px" alt="profile_picture"
                                        class="rounded-full w-20 h-20 mx-auto">
                                    <?php endif;?>
                                    <p class="text-center text-lg mt-2"><?php echo $username; ?></p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <a href="../backend/api/logout.php"
                                        class="block px-6 py-3 text-gray-800 hover:bg-gray-300">Çıkış Yap</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else:?>
                    <!-- {/* Right side - Auth Buttons */} -->
                    <div class="flex items-center space-x-4">
                        <a href="registar.php"
                            class="bg-[#1b1f24] text-white text-md px-6 py-3 rounded-full hover:bg-gray-800 transition-colors">
                            Register
                        </a>
                        <a href="login.php"
                            class="bg-gray-100 text-gray-900 text-md px-6 py-3 rounded-full hover:bg-gray-200 transition-colors">
                            Login
                        </a>
                    </div>
                    <?php endif;?>

                </nav>
            </div>
        </div>

        <!-- main h1 text -->
        <h1 class="text-4xl md:text-4xl font-bold tracking-tighter scale-in !important justify-self-center mt-32"
            id="title">
            <span class="text-white !important">Favori COINS</span>
        </h1>    


        <div class="w-full overflow-x-auto max-w-7xl justify-self-center mt-10 mt-24" id="BoşKontorl">
            <table class="w-full border-separate border-spacing-0">
                <!-- Table Header -->
                <thead>
                    <tr>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                #
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                Name
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                Price
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                Change
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                24h Volume
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-left">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                Market Cap
                            </div>
                        </th>
                        <th class="whitespace-nowrap px-6 py-3 text-right">
                            <div class="flex items-center justify-end gap-2 text-sm font-medium text-gray-400">
                                favorite
                            </div>
                        </th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody id="tbodyy">
                    <!-- veriler -->
                </tbody>
            </table>
        </div>
</div>

    <script>
        

        async function fetchFavorites() { 
            try {
                const response = await fetch('http://localhost/WebProje/backend/api/get_favorite.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                const data = await response.json();
                Get_Coin(data.favorites);
            } catch (error) {
                // <h1 class="text-white text-3xl text-center mt-32">Hiç Favorin Yok</h1>BoşKontorl
                const table = document.getElementById("BoşKontorl")
                let bildiri = `
                    <h1 class="text-white text-2xl text-center mt-32">Kayıtlı Hiç bir Favori Coin'nin Yok</h1>
                `
                table.innerHTML = ""
                table.innerHTML = bildiri
            }
        }
        fetchFavorites();

        function Get_Coin(arr){
            fetch('https://min-api.cryptocompare.com/data/top/mktcapfull?limit=50&tsym=USD')
            .then(response => response.json())
            .then(data => {
                console.log(data.Data); // Konsola veriyi yazdırma
                let tr = "";

                for (let i = 0; i < data.Data.length; i++) {
                    try{
                        const match = data.Data.find(item => item.CoinInfo.Name === arr[i]);
                        if (match) {
                            console.log("Eşleşen öğe bulundu:", match);
                            tr += `
                                <tr class="border-b border-gray-800">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="text-white">${i + 1}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                <img class="rounded-full" src="https://www.cryptocompare.com${match.CoinInfo.ImageUrl}">
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">${match.CoinInfo.Name}</div>
                                                <div class="text-sm text-gray-400">${match.CoinInfo.FullName}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="text-white">${match.DISPLAY.USD.PRICE}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="${match.DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600' : 'text-emerald-400'}">${match.DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${match.DISPLAY.USD.CHANGEPCTDAY}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="text-white">$137.98B</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="text-white">${match.DISPLAY.USD.CIRCULATINGSUPPLYMKTCAP}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button type="submit" class="rounded-lg p-2 transition-colors hover:bg-gray-800" onclick="ClearFav('${match.CoinInfo.Name}'); location.reload();"">
                                                <i class="fa-solid fa-x" style="color: #ff0000;"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                    }catch(e){
                        continue;
                    }
                }
                document.getElementById("tbodyy").innerHTML += tr;
            });

        }
        setInterval(Get_Coin, 30000); 
        
        function ClearFav(name){
            console.log(name)
            fetch("http://localhost/WebProje/backend/api/clear_favorite.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ name: name }),
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
        }

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