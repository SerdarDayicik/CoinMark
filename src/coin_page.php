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
    <link href="./output.css" rel="stylesheet">
    <title>Coin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .custom-bg {
        background: linear-gradient(to bottom, #010409 95%, #010409 97%, #00023A 100%);
    }
    </style>
</head>

<body>

    <div class="min-h-screen custom-bg">
        <!-- navbar -->
        <div class="sticky top-0 z-50 w-full transition-all duration-300 ease-in-out ">
            <div class="flex justify-center w-full px-4 py-4">
                <nav
                    class="flex items-center justify-between w-full max-w-7xl px-6 py-3 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-full shadow-md">
                    <!-- nav sol kısım -->
                    <div class="flex items-center space-x-2">
                        <a href="index.php">
                            <span class="font-semibold text-3xl">
                                SerdarDyck
                            </span>
                        </a>
                    </div>

                    <!-- nav orta kısım -->
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
                    <!-- nav sağ kısım -->
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
            <span class="text-white !important">COIN MARKETS</span>
        </h1>
        
        <!-- hot, NewList, top volume kutular -->
        <div class="px-4 w-full mt-14 mb-20">
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 w-9/12 justify-self-center">
                <!-- Hot Coins Section -->
                <div class="rounded-xl bg-[#222222] p-4">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-200">Hot Coins</h2>
                    </div>
                    <div class="space-y-3" id="hotCoins">

                    </div>
                </div>

                <!-- New Listing Section -->
                <div class="rounded-xl bg-[#222222] p-4">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-200">New Listing</h2>
                    </div>
                    <div class="space-y-3" id="newList">

                    </div>
                </div>

                <!-- Top Gainer Coin Section -->
                <div class="rounded-xl bg-[#222222] p-4">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-200">Top Gainer Coin</h2>
                    </div>
                    <div class="space-y-3" id="topGainer">

                    </div>
                </div>

                <!-- Top Volume Coin Section -->
                <div class="rounded-xl bg-[#222222] p-4">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-200">Top Volume Coin</h2>
                    </div>
                    <div class="space-y-3" id="topVolume">

                    </div>
                </div>
            </div>
        </div>




        <div class="w-full overflow-x-auto max-w-7xl justify-self-center">
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
        function favAdd(name){
            console.log(name,1)
            fetch("http://localhost/WebProje/backend/api/add_favorite.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ name: name }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success == false) {
                    window.location.href = "login.php"
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
        }
        function Get_Coin(){
            fetch('https://min-api.cryptocompare.com/data/top/mktcapfull?limit=50&tsym=USD')
                .then(response => response.json())
                .then(data => {
                        document.getElementById("topGainer").innerHTML = "";
                        console.log(data.Data); // Konsola veriyi yazdırma
                        let tr = "";
                        let hotCoin = "";
                        let newList = "";
                        let topGainer = "";
                        let topVolume = "";
                        for (let i = 0; i < data.Data.length; i++) {
                            try{
                                        tr += `
                                                <tr class="border-b border-gray-800">
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <span class="text-white">${i+1}</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <div class="flex items-center gap-3">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                            <class class="h-7 w-7 text-white">
                                                                <img class="rounded-full" src="https://www.cryptocompare.com${data.Data[i].CoinInfo.ImageUrl}">
                                                            </class>
                                                        </div>
                                                        <div>
                                                            <div class="font-medium text-white">${data.Data[i].CoinInfo.Name}</div>
                                                            <div class="text-sm text-gray-400">${data.Data[i].CoinInfo.FullName}</div>
                                                        </div>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <span class="text-white">${data.Data[i].DISPLAY.USD.PRICE}</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <span class="${data.Data[i].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[i].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[i].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <span class="text-white">$137.98B</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <span class="text-white">${data.Data[i].DISPLAY.USD.CIRCULATINGSUPPLYMKTCAP}</span>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4" onclick="FavCek();">
                                                        <div class="flex justify-end gap-2">
                                                            <button class="rounded-lg p-2 transition-colors hover:bg-gray-800" onclick="favAdd('${data.Data[i].CoinInfo.Name}')">
                                                                <i id="${data.Data[i].CoinInfo.Name}" class="fa-regular fa-star" style="color: #ffffff;" id="${i}"></i>  
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                            
                                            `

                                        hotCoin = `
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                            <img class="rounded-full" src="https://www.cryptocompare.com/media/37746251/btc.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[0].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[0].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/37746238/eth.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[1].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[1].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[1].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[1].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/37747734/sol.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[4].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[4].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[4].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[4].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                </div>
                                            `

                                        newList = `
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                            <img class="rounded-full" src="https://www.cryptocompare.com/media/44082045/sui.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[8].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[8].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[8].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[8].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/37621928/steth.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[10].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[10].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[10].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[10].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[10].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/44145694/wld.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[11].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[11].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[11].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[11].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[11].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                </div>
                                            `
                                        if (2 < data.Data[i].DISPLAY.USD.CHANGEPCTDAY) {
                                            topGainer += `
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center gap-2">
                                                            <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                            <img class="rounded-full" src="https://www.cryptocompare.com${data.Data[i].CoinInfo.ImageUrl}">
                                                            </div>
                                                            <div class="flex flex-col">
                                                            <span class="text-sm font-medium text-white">${data.Data[i].CoinInfo.Name}</span>
                                                            <span class="text-[13px] text-gray-400">${data.Data[i].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[i].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[i].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[i].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                </div>
                                            `
                                        }

                                        topVolume = `
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                            <img class="rounded-full" src="https://www.cryptocompare.com/media/37746251/btc.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[0].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[0].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[0].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[0].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/37746238/eth.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[1].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[1].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[1].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[1].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[1].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full">
                                                        <img class="rounded-full" src="https://www.cryptocompare.com/media/38553096/xrp.png">
                                                        </div>
                                                        <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-white">${data.Data[2].CoinInfo.Name}</span>
                                                        <span class="text-[13px] text-gray-400">${data.Data[2].DISPLAY.USD.PRICE}</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium ${data.Data[2].DISPLAY.USD.CHANGEPCTDAY < 0 ? 'text-red-600 !important' : 'text-emerald-400'}">${data.Data[2].DISPLAY.USD.CHANGEPCTDAY < 0 ? "" : "+"} ${data.Data[2].DISPLAY.USD.CHANGEPCTDAY}</span>
                                                </div>
                                        `
                            }
                            catch(e){
                                    continue;
                            }
                        }
                        document.getElementById("tbodyy").innerHTML = tr;
                        document.getElementById("hotCoins").innerHTML = hotCoin;
                        document.getElementById("newList").innerHTML = newList;
                        document.getElementById("topVolume").innerHTML = topVolume;
                        document.getElementById("topGainer").innerHTML = topGainer;
                    })
                    

        };
        Get_Coin();

        async function FavCek(){
            try {
                const response = await fetch('http://localhost/WebProje/backend/api/get_favorite.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                const data = await response.json();
                console.log(data)
                for(let i = 0; i < data.favorites.length; i++){
                    document.getElementById(`${data.favorites[i]}`).classList.remove('fa-regular', 'fa-star')
                    document.getElementById(`${data.favorites[i]}`).classList.add('fa-solid', 'fa-star')
                }
            } catch (error) {
                console.log(error)
            }
        }
        FavCek();

        setInterval(Get_Coin, 30000); 
        // Dropdown menüsünü aç kapa
        const dropdownButton = document.getElementById('profile-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');

        dropdownButton.addEventListener('click', function(event) {
            dropdownMenu.classList.toggle('hidden'); // Menü açma/kapama
        });

        // Dropdown farklı yere tıklama işlemi
        window.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

    </script>
</body>

</html>