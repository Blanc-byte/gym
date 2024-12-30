
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    @if($activeSubscription)
                        <h3 class="text-2xl font-bold mb-6 text-indigo-600">{{ __('Your Active Subscription') }}</h3>
                        <div class="border rounded-lg p-6 shadow-md bg-indigo-50">
                            <h4 class="text-xl font-semibold mb-2 text-indigo-800">
                                {{ $activeSubscription->subscription_type }}
                            </h4>
                            <p class="text-gray-700 mb-4">{{ __('Start Date: ') }} {{ \Carbon\Carbon::parse($activeSubscription->subscription_start_date)->format('M d, Y') }}</p>
                            <p class="text-gray-700 mb-4">{{ __('Expiry Date: ') }} {{ \Carbon\Carbon::parse($activeSubscription->subscription_expiry_date)->format('M d, Y') }}</p>
                            <p class="text-lg font-bold mb-4 text-indigo-900">{{ __('Amount Paid: $') }}{{ number_format($activeSubscription->amount, 2) }}</p>
                            <p class="text-gray-600">{{ __('If you wish to change your plan, please contact staff.') }}</p>
                        </div>
                    @elseif($pendingSubscription)
                        <h3 class="text-3xl font-bold mb-1 text-indigo-600">{{ __('Your Pending Subscription') }}</h3>
                        <p class="text-gray-600  mb-6">{{ __('Wait for the Staff to approve your subscription') }}</p>
                        <div class="border rounded-lg p-6 shadow-md bg-indigo-50 mb-6">
                            <h4 class="text-xl font-semibold mb-2 text-indigo-800">
                                {{ $pendingSubscription->subscription_type }}
                            </h4>
                            <p class="text-lg font-bold mb-4 text-indigo-900">{{ __('Amount Paid: $') }}{{ number_format($pendingSubscription->amount, 2) }}</p>
                            <p class="text-gray-600">{{ __('If you wish to change your plan, you can select a different plan below.') }}</p>
                        </div>

                        <h3 class="text-2xl font-bold mb-6 text-indigo-600">{{ __('Choose a Different Plan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($plans as $plan)
                                @if($plan->name !== $pendingSubscription->subscription_type) <!-- Exclude the pending plan -->
                                    <div class="border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow bg-indigo-50">
                                        <h4 class="text-xl font-semibold mb-2 text-indigo-800">
                                            {{ $plan->name }} ({{ $plan->month }} {{ $plan->month == 1 ? 'Month' : 'Months' }})
                                        </h4>
                                        <p class="text-gray-700 mb-4">{{ $plan->description }}</p>
                                        <p class="text-lg font-bold mb-4 text-indigo-900">{{ __('Price: $') }}{{ number_format($plan->price, 2) }}</p>
                                        <form method="POST" action="{{ route('subscribe') }}">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="hidden" name="switch_plan" value="1"> 
                                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 w-full">
                                                {{ __('Switch to This Plan') }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @empty
                                <div class="col-span-full text-center text-gray-500">
                                    {{ __('No other plans available at the moment.') }}
                                </div>
                            @endforelse
                        </div>
                    @else
                        <h3 class="text-2xl font-bold mb-6 text-indigo-600">{{ __('Choose Your Plan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($plans as $plan)
                                    <div class="border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow bg-indigo-50">
                                        <h4 class="text-xl font-semibold mb-2 text-indigo-800">
                                            {{ $plan->name }} ({{ $plan->month }} {{ $plan->month == 1 ? 'Month' : 'Months' }})
                                        </h4>
                                        <p class="text-gray-700 mb-4">{{ $plan->description }}</p>
                                        <p class="text-lg font-bold mb-4 text-indigo-900">{{ __('Price: $') }}{{ number_format($plan->price, 2) }}</p>
                                        <form method="POST" action="{{ route('subscribe') }}">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 w-full">
                                                {{ __('Subscribe') }}
                                            </button>
                                        </form>
                                    </div>
                            @empty
                                <div class="col-span-full text-center text-gray-500">
                                    {{ __('No plans available at the moment.') }}
                                </div>
                            @endforelse
                        </div>
                    @endif

                    </div>
                </div>
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

