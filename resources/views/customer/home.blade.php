    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .hero {
                background-image: url("{{ asset('image/background.png') }} ");
            }
        </style>
    </head>
    <body>
        @include('layouts.cusNav')

        
    <section class="relative bg-cover bg-center h-screen hero">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900 to-transparent opacity-90"></div>

                <!-- Content -->
            <div class="relative z-10 container mx-auto flex flex-col md:flex-row items-center justify-between h-full px-4 md:px-12">
                <!-- Left Content -->
                <div class="text-white max-w-lg text-center md:text-left space-y-4">
                    <h1 class="text-2xl md:text-5xl font-bold leading-tight">
                        Start a better <br> shape of you!
                    <!-- </h1>
                    <p class="text-yellow-400 text-2xl font-semibold">
                        Come Join Us!
                    </p> -->
                    <a href="{{ route('subscribe') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold">
                    Subscribe
                    </a>
                </div>

                <!-- Right Content -->
                <div class="mt-6 md:mt-0">
                    <img src="{{ asset('image/logo.png') }}" alt="Stamina Fitness Logo" class="h-[600px] w-[561px]">
                </div>
            </div>
    </section>

    <!-- About Section -->
    <section class="bg-indigo-900 h-[75vh] text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div>
                <h2 class="text-3xl font-bold mb-4">About <br> <span class="text-indigo-400">Dorsu GYM FOR MAN & WOMAN</span></h2>
                <p class="text-lg text-yellow-200 leading-relaxed mb-6">
                    Dorsu Gym Fitness Center provides proper training and conditioning for members who want to improve and transform their body with a program tailored to their body composition.
                </p>
                <h3 class="text-4xl font-semibold mb-4">What we offer:</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Feature 1 -->
                    <div class="bg-white text-indigo-900 rounded-lg p-4 shadow-md text-center">
                        <div class="text-3xl font-bold">24/7</div>
                        <p class="mt-2">Chat</p>
                    </div>
                    <!-- Feature 2 -->
                    <div class="bg-white text-indigo-900 rounded-lg p-4 shadow-md text-center">
                        <div class="text-3xl font-bold">1 on 1</div>
                        <p class="mt-2">Coaching</p>
                    </div>
                    <!-- Feature 3 -->
                    <div class="bg-white text-indigo-900 rounded-lg p-4 shadow-md text-center">
                        <div class="text-3xl font-bold">Proper</div>
                        <p class="mt-2">Plan Guide</p>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="relative">
                <img src="{{ asset('image/background.png') }}" alt="Gym Equipment" class="rounded-lg shadow-lg">
                <!-- Optional Overlay -->
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-indigo-900 to-transparent opacity-50"></div>
            </div>
        </div>
    </section>

<!-- Plans Section -->

<section class="bg-white py-12">
        <div class="container mx-auto px-6 lg:px-12 text-center">
            <h1 class="text-3xl font-bold text-indigo-700 mb-4">Our Plan:</h1>
            <p class="text-lg text-gray-700 mb-8">JOIN OUR MEMBERSHIP</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <!-- Basic Plan -->
                <div class="bg-indigo-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-indigo-700 mb-2">Basic Plan</h3>
                    <p class="text-gray-700 mb-4">1 Month</p>
                    <p class="text-sm text-gray-600 mb-4">Personal training session</p>
                    <p class="text-xl font-bold text-indigo-700">$20</p>
                </div>
                <!-- Standard Plan -->
                <div class="bg-indigo-200 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-indigo-800 mb-2">Standard Plan</h3>
                    <p class="text-gray-800 mb-4">2 Months</p>
                    <p class="text-sm text-gray-700 mb-4">Two free personal training sessions</p>
                    <p class="text-xl font-bold text-indigo-800">$30</p>
                </div>
                <!-- Premium Plan -->
                <div class="bg-indigo-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-indigo-900 mb-2">Premium Plan</h3>
                    <p class="text-gray-900 mb-4">3 Months</p>
                    <p class="text-sm text-gray-800 mb-4">Four free personal training sessions</p>
                    <p class="text-xl font-bold text-indigo-900">$50</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
<footer class="bg-indigo-900 text-white py-6">
    <div class="container mx-auto px-6 lg:px-12 text-center">
        <div class="mb-4">
            <h3 class="text-lg font-bold uppercase">Dorsu Gym Fitness Center</h3>
            <p class="text-sm text-indigo-300">Your journey to a better you starts here.</p>
        </div>
        <div class="flex justify-center space-x-6 mb-4">
            <!-- Social Media Icons -->
            <a href="#" class="hover:text-yellow-400"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="hover:text-yellow-400"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#" class="hover:text-yellow-400"><i class="fab fa-twitter"></i> Twitter</a>
        </div>
        <div class="text-sm text-indigo-300">
            <p>© 2024 Dorsu Gym Fitness Center. All Rights Reserved.</p>
            <p class="mt-1">Designed with ❤️ by <span class="text-yellow-400">Blanc Group</span></p>
        </div>
    </div>
</footer>
</body>
</html>
