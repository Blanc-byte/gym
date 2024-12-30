<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index()
    {
        $activeSubscription = Payment::where('member_id', auth()->id())
        ->where('subscription_status', 'subscribe')
        ->first();
        $pendingSubscription = Payment::where('member_id', auth()->id())
        ->where('subscription_status', 'pending')
        ->first();

        $plans = [];
        if (!$activeSubscription) {
            $plans = Subscription::all();
        }
        return view('customer.subscribe', compact('plans', 'activeSubscription', 'pendingSubscription'));
    }

    public function redirectPayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer'
        ]);

        // Fetch the plan object based on the ID
        $plan = Subscription::findOrFail($request->input('plan_id'));

        // Check if the user is switching plans
        $isSwitchPlan = $request->input('switch_plan') === '1';

        $refundAmount = 0; // Initialize refund amount

        if ($isSwitchPlan) {
            // Fetch the user's pending subscription
            $pendingSubscription = Payment::where('member_id', auth()->id())
                ->where('subscription_status', 'pending')
                ->first();

            if ($pendingSubscription) {
                // Capture the refund amount as the full amount of the previous plan
                $refundAmount = $pendingSubscription->amount;

                // Do not delete or update here; just capture the refund amount
            }
        }

        // Store the selected plan and refund information in the session
        session([
            'selected_plan' => $plan,
            'refundAmount' => $refundAmount,
        ]);

        // Redirect to the payment page
        return redirect()->route('payment');
    }

}