<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Subscriptions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero {
            background-image: url("{{ asset('image/background.png') }}");
        }
    </style>
</head>
<body>
    @include('layouts.cusNav')

    <section class="relative bg-cover bg-center min-h-screen p-8 hero">
        <!-- Overlay for better readability -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Content Wrapper -->
        <div class="relative z-10 flex items-center justify-center">
            <div class="container mx-auto">
                <h1 class="text-5xl font-bold text-white text-center mb-8">My Subscriptions</h1>

                @if ($subscriptions->isEmpty())
                    <div class="bg-white bg-opacity-80 rounded-xl shadow-lg p-8 text-center mx-auto max-w-md">
                        <p class="text-gray-700 text-lg font-semibold">
                            You currently have no trainers assigned. Please subscribe to a plan!
                        </p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($subscriptions as $subscription)
                            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
                                <h2 class="text-2xl font-bold text-indigo-600 mb-4">
                                    {{ $subscription->subscription_type }}
                                </h2>
                                <p class="text-sm text-gray-500 mb-4">
                                    <strong>Status:</strong> {{ ucfirst($subscription->subscription_status) }}
                                </p>
                                <p class="text-sm text-gray-500 mb-4">
                                    <strong>Start Date:</strong> {{ $subscription->subscription_start_date ?? 'Not Started' }}
                                </p>
                                <p class="text-sm text-gray-500 mb-6">
                                    <strong>Expiry Date:</strong> {{ $subscription->subscription_expiry_date ?? 'N/A' }}
                                </p>

                                <!-- Trainers Section -->
                                @if (strtolower(trim($subscription->subscription_status)) === 'subscribe')
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">Assigned Trainers:</h3>
                                    @forelse ($subscription->trains as $train)
                                        <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-4 mb-4">
                                            <img src="{{ asset('image/PersonCircle.png') }}" alt="Trainer Photo" class="w-12 h-12 rounded-full object-cover" />
                                            <div>
                                                <h4 class="text-md font-semibold text-indigo-600">
                                                    {{ $train->instructor->name }}
                                                </h4>
                                                <p class="text-sm text-gray-700">
                                                    <strong>Specialty:</strong> {{ $train->instructor->specialty }}
                                                </p>
                                                <p class="text-sm text-gray-700">
                                                    <strong>Class Duration / Day:</strong> {{ $train->instructor->duration }} hours
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 italic">No trainers assigned to this subscription yet.</p>
                                    @endforelse
                                @else
                                    <p class="text-gray-500 italic">
                                        Trainers are not available for {{ ucfirst($subscription->subscription_status) }} subscriptions.
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

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