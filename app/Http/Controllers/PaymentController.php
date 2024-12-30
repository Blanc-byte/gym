<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function show()
    {
          // Retrieve the plan object from the session
        $plan = session('selected_plan');

        // Check if the plan exists in the session
        if (!$plan) {
            return redirect()->route('home')->with('error', 'No plan selected.');
        }

        // Pass the plan object to the view
        return view('customer.payment', ['plan' => $plan]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'subscription_type' => 'required|string',
            'amount' => 'required|int',
        ]);

        // Check if this is a refund-related case
        $refundAmount = session('refundAmount', null); // Get refund amount from session, default to null

        // Find the existing pending payment for the user
        $payment = Payment::where('member_id', $request->input('member_id'))
            ->where('subscription_status', 'pending')
            ->first();

        if ($refundAmount && $payment) {
            // If refund is involved and there's an existing pending payment, update it
            $payment->update([
                'subscription_type' => $request->input('subscription_type'),
                'amount' => $request->input('amount'), // New plan amount
                'payment_date' => now(), // Update payment date
            ]);

            // Optionally store refund details in a log or message
            session()->flash('refundInfo', "Refund amount from the previous plan: $refundAmount");
        } else {
            // If no refund or pending payment exists, create a new payment entry
            Payment::create([
                'member_id' => $request->input('member_id'),
                'subscription_type' => $request->input('subscription_type'),
                'subscription_start_date' => null, // Default as null
                'subscription_expiry_date' => null, // Default as null
                'amount' => $request->input('amount'), // Default as null
                'payment_date' => now(), // Current date and time
                'subscription_status' => 'pending', // Default as 'pending'
            ]);
        }

        // Redirect to a confirmation page or back to the payment page
        return redirect()->route('home')->with('success', 'Payment processed successfully!');
    }



}
