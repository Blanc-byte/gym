<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero {
            background-image: url("{{ asset('image/background.png') }}");
        }
    </style>
</head>
<body>
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <!-- Refund Information -->
        @if(session('refundAmount') > 0)
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
                <h2 class="text-green-800 font-semibold">Refund Information</h2>
                <p class="text-green-700">
                    {{ __('You paid $') }}{{ number_format(session('refundAmount'), 2) }}
                    {{ __(' for your previous plan: ') }}{{ session('previousPlan') }}.<br>
                    {{ __('This amount was refunded to you.') }}
                </p>
            </div>
        @endif

        <!-- Subscription Details -->
        @if(session('selected_plan'))
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Subscribe to {{ session('selected_plan')->name }}
                </h1>
                <p class="text-gray-600 text-lg mt-2">
                    <span class="text-3xl font-semibold text-gray-900">$ {{ session('selected_plan')->price }}</span>
                    <span class="text-sm text-gray-500">for {{ session('selected_plan')->month }} month(s)</span>
                </p>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Payment Details -->
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-700">Subtotal</span>
                    <span class="text-gray-900 font-medium">${{ session('selected_plan')->price }}</span>
                </div>

                <div class="border-t border-gray-200"></div>

                <div class="flex justify-between">
                    <span class="text-lg font-bold text-gray-800">Total due today</span>
                    <span class="text-lg font-bold text-gray-900">${{ session('selected_plan')->price }}</span>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Payment Button -->
            <div class="text-center">
                <form method="POST" action="{{ route('savePayment') }}">
                    @csrf
                    <input type="hidden" name="subscription_type" value="{{ session('selected_plan')->name }}">
                    <input type="hidden" name="member_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="amount" value="{{ session('selected_plan')->price }}">

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 focus:outline-none">
                        Proceed to Payment
                    </button>
                </form>
            </div>
        @else
            <div>
                <p>No plan selected. Please go back and choose a plan.</p>
            </div>
        @endif
    </div>

</body>
</html>
