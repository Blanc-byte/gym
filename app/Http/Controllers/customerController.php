<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
class customerController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function home()
    {
        return view("customer.home");
    }
    public function trainor()
    {
        $userId = auth()->id(); // Get the logged-in user's ID.

        // Fetch subscriptions with their associated trains and trainers
        $subscriptions = Payment::with([
            'trains.instructor' // Load trains and their associated instructors
        ])->where('member_id', $userId)->get();

        return view("customer.trainor", compact('subscriptions'));
    }
    
}
