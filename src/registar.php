<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <style>
        /* Skewed image styling */
        .skewed img {
            transform: skewX(-10deg) translateX(-10%);
            transform-origin: left; /* Transformation starts from the left */
            object-fit: cover;
            width: calc(100% + 20%); /* Increase the image width */
            height: 100%;
        }

        /* Image slider styling */
        #image-slider img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out; /* Fade effect */
        }

        #image-slider img.active {
            opacity: 1;
            z-index: 1;
        }

        #image-slider img.hidden {
            opacity: 0;
            z-index: 0;
        }

        /* Fade-out effect */
        #image-slider img.fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-in-out; /* Shorter fade-out time */
        }

        /* Fade-in effect */
        #image-slider img.fade-in {
            opacity: 1;
            transition: opacity 1s ease-in-out; /* Fade-in animation */
        }
    </style>
</head>
<body class="bg-[#1a1b3a]">
  <div class="min-h-screen w-full flex relative">
    <!-- Back to Home Icon (Sağ Üst) -->
    <a href="/webproje/src" class="absolute top-4 right-5 p-3 bg-[#2a2b4a] rounded-full text-white hover:bg-[#3a3b5a] transition-colors">
        <i class="fas fa-home text-xl"></i>
    </a>

    <!-- Left side - Hero Image with slider -->
    <div class="hidden lg:block lg:w-4/6 relative skewed rounded-3xl overflow-hidden">
      <div id="image-slider" class="absolute top-0 left-0 w-full h-full">
        <img src="../public/1.jpg" alt="Image 1" class="object-cover" />
        <img src="../public/2.jpg" alt="Image 1" class="object-cover" />
        <img src="../public/3.png" alt="Image 1" class="object-cover" />
        <img src="../public/4.jpg" alt="Image 1" class="object-cover" />
        <img src="../public/5.jpg" alt="Image 1" class="object-cover" />
      </div>
    </div>

    <!-- Right side - Login Form -->
    <div class="w-full flex flex-col items-center justify-center lg:w-1/2 bg-[#1a1b3a] p-8 h-screen">
      <div class="w-full max-w-md space-y-8">
        <!-- Header -->
        <div class="text-center space-y-2">
          <h1 class="text-4xl font-bold text-white">Welcome Back</h1>
          <p class="text-gray-400">Please Registar to Continue</p>
        </div>

        <!-- Form -->
        <form class="space-y-6" action="../backend/api/registar.php" method="POST">
          <div class="space-y-4">
            <!-- Username/Email field -->
            <div class="space-y-2">
              <label for="email" class="text-gray-400">Username or Email</label>
              <div class="relative">
                <input 
                  id="username" 
                  type="text" 
                  name="username"
                  placeholder="Enter your username or email" 
                  class="bg-[#2a2b4a] border-0 text-white pl-10 py-2 w-full"
                />
                <svg 
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                  />
                </svg>
              </div>
            </div>

            <!-- Password field -->
            <div class="space-y-2">
              <label for="password" class="text-gray-400">Password</label>
              <div class="relative">
                <input 
                  id="password" 
                  type="password" 
                  name="password"
                  placeholder="Enter your password" 
                  class="bg-[#2a2b4a] border-0 text-white pl-10 py-2 w-full"
                />
                <svg 
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                  />
                </svg>
              </div>
            </div>
          </div>

          <!-- Remember me and Forgot password -->
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
              <input 
                id="remember" 
                type="checkbox" 
                class="border-gray-400 text-[#7c3aed]"
              />
              <label for="remember" class="text-sm text-gray-400">Remember Me</label>
            </div>
            <a href="/forgot-password" class="text-sm text-[#7c3aed] hover:text-[#9061ff]">Forget Password ?</a>
          </div>

          <!-- Login button -->
          <button class="w-full bg-[#7c3aed] hover:bg-[#9061ff] text-white py-2">Login</button>
        </form>

                  <!-- Divider -->
        <div class="relative">
           <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-600"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 text-gray-400 bg-[#1a1b3a]">Or</span>
            </div>
        </div>

          <!-- Social login buttons -->
          <div class="flex justify-center space-x-6">
            <!-- Google button with Font Awesome icon -->
            <button href="../backend/api/google_login.php" class="p-2 bg-[#2a2b4a] rounded-full hover:bg-[#3a3b5a] transition-colors">
              <a href="../backend/api/google_login.php">
                  <i class="fab fa-google w-6 h-6 text-white"></i>
              </a>
            </button>

            <!-- Facebook button with Font Awesome icon -->
            <button class="p-2 bg-[#2a2b4a] rounded-full hover:bg-[#3a3b5a] transition-colors">
                <i class="fab fa-facebook-f w-6 h-6 text-white"></i>
            </button>

            <!-- Apple button with Font Awesome icon -->
            <button class="p-2 bg-[#2a2b4a] rounded-full hover:bg-[#3a3b5a] transition-colors">
                <i class="fab fa-apple w-6 h-6 text-white"></i>
            </button>
          </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-400">
          © 2024 Poorna Kawishla | All Rights Reserved
        </p>
      </div>
    </div>
  </div>

  <!-- JavaScript for Image Slider with Animation -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const images = document.querySelectorAll("#image-slider img");
      let currentIndex = 0;

      function changeImage() {
        // Add fade-out effect to the current image
        images[currentIndex].classList.add("fade-out");
        
        // After fade-out is complete, hide the current image and show the next one
        setTimeout(function() {
          images[currentIndex].classList.remove("active", "fade-out");
          images[currentIndex].classList.add("hidden");

          // Move to the next image in the slider
          currentIndex = (currentIndex + 1) % images.length;
          images[currentIndex].classList.remove("hidden");
          images[currentIndex].classList.add("active");
          images[currentIndex].classList.add("fade-in");
        }, 500); // Wait for the fade-out animation to finish

        // Fade-in effect for the new image
        setTimeout(function() {
          images[currentIndex].classList.remove("fade-in");
        }, 1000); // Duration of the fade-in animation
      }

      // Initialize the first image as active
      images[currentIndex].classList.add("active");
      setInterval(changeImage, 5000);
    });
  </script>
</body>
</html>
