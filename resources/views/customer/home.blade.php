<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</body>
</html>
