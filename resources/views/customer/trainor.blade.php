<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero {
            background-image: url("{{ asset('image/background.png') }} ");
        }
    </style>
</head>
<body>
    @include('layouts.cusNav')

    
    <section class="relative bg-cover bg-center h-screen p-8 hero">
        <!-- Overlay for better readability -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Content Wrapper -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-8">My Subscriptions</h1>

                @if ($subscriptions->isEmpty())
                    <div class="bg-white bg-opacity-80 rounded-xl shadow-lg p-8">
                        <p class="text-gray-700 text-lg font-semibold">
                            You currently have no trainers assigned. Please subscribe to a plan!
                        </p>
                    </div>
                @else
                    <div class="space-y-8">
                        @foreach ($subscriptions as $subscription)
                            <div class="bg-white rounded-xl shadow-md p-6 w-96 mx-auto hover:shadow-lg transition-all duration-300">
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

                                <h3 class="text-lg font-bold text-gray-800 mb-2">Assigned Trainers:</h3>
                                @forelse ($subscription->trains as $train)
                                    <div class="bg-gray-100 p-4 rounded-lg flex items-center gap-4 mb-4">
                                        <img src="{{ asset('image/PersonCircle.png')}}" alt="Trainer Photo" class="rounded-full object-cover" />
                                        <div>
                                            <h4 class="text-md font-semibold text-indigo-600">
                                                {{ $train->instructor->name }}
                                            </h4>
                                            <p class="text-sm text-gray-700">
                                                <strong>Session Type:</strong> {{ $train->sessionType }}
                                            </p>
                                            <p class="text-sm text-gray-700">
                                                <strong>Duration:</strong> {{ $train->sessionDuration }} hours
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 italic">No trainers assigned to this subscription yet.</p>
                                @endforelse

                                <button
                                    class="mt-4 w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg shadow-md hover:from-indigo-600 hover:to-purple-700 focus:ring-4 focus:ring-indigo-300 focus:outline-none transition-all duration-300">
                                    View More Details
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</body>
</html>
