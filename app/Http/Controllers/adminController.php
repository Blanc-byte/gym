<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Trainor; 

class adminController extends Controller
{
    public function getAllUnsubscribe()
    {
        
        $members = DB::select('SELECT u.name, u.email,  s.* FROM subscriptions s
                                JOIN users u ON s.member_id = u.id 
                                WHERE s.subscription_status = "pending";');

        $trainors = Trainor::all();

        return view('admin.subscription', [
            'members' => $members,
            'trainors' => $trainors
        ]);
    }
    public function assignTrainers(Request $request)
    {
        $validatedData = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'trainer_ids' => 'required|array',
            'trainer_ids.*' => 'exists:trainors,id'
        ]);

        $subscriptionId = $validatedData['subscription_id'];
        $trainerIds = $validatedData['trainer_ids'];

        try {

            foreach ($trainerIds as $index => $trainerId) {
                // Insert into the 'trains' table
                DB::table('trains')->insert([
                    'instructor_id' => $trainerId,
                    'subscription_id' => $subscriptionId,
                ]);
            }
            
            // Calculate the subscription expiry date based on the count of trainers
            $trainerCount = count($trainerIds);
            $subscriptionExpiryDate = now()->addMonths($trainerCount);
            
            // Update the 'subscriptions' table
            DB::table('subscriptions')
                ->where('id', $subscriptionId)
                ->update([
                    'subscription_start_date' => now(),
                    'subscription_expiry_date' => $subscriptionExpiryDate,
                    'subscription_status' => 'subscribe', 
                ]);


            return response()->json(['success' => true, 'message' => 'Trainers assigned successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to assign trainers']);
        }
    }
    
    public function viewClients()
    {
        
        $subscriptions = DB::select('SELECT * FROM subscriptions WHERE subscription_status = "subscribe";');

        $clients = DB::table('users')
                        ->where('role', '=', 'customer')
                        ->get();

        return view('admin.viewClients', [
            'clients' => $clients,
            'subscriptions' => $subscriptions
        ]);
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('subscriptions')->where('member_id', $id)->delete();

        return redirect()->back()->with(['message' => 'Success'], 404);
    }

    public function unsubscribe($id)
    {
        
        DB::table('subscriptions')->where('member_id', $id)->delete();

        return redirect()->back()->with(['message' => 'Success'], 404);
    }

    
    public function trainers()
    {
        $trainers = DB::table('trainors')
                        ->get();

        return view('admin.trainers', ['trainers' => $trainers]);
    }
// Store a new trainer
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required',
        'age' => 'required|integer',
        'gender' => 'required|string',
        'specialty' => 'required|string',
        'duration' => 'required|integer',
    ]);

    // Create a new trainer
    Trainor::create([
        'name' => $request->name,
        'age' => $request->age,
        'gender' => $request->gender,
        'specialty' => $request->specialty,
        'duration' => $request->duration,
    ]);

    return redirect()->back()->with(['message' => 'Success'], 404);
}

// Show the edit form with data
public function edit($id)
{
    $trainer = Trainor::findOrFail($id);
    return redirect()->back()->with(['message' => 'Success'], 404);
}

// Update the trainer data
public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required',
        'age' => 'required|integer',
        'gender' => 'required|string',
        'specialty' => 'required|string',
        'duration' => 'required|integer',
    ]);

    $trainer = Trainor::findOrFail($id);

    // Update the trainer's data
    $trainer->update([
        'name' => $request->name,
        'age' => $request->age,
        'gender' => $request->gender,
        'specialty' => $request->specialty,
        'duration' => $request->duration,
    ]);

    return redirect()->back()->with(['message' => 'Success'], 404);
}

// Delete a trainer
public function destroyTrainer($id)
{
    $trainer = Trainor::findOrFail($id);
    $trainer->delete();

    return redirect()->back()->with(['message' => 'Success'], 404);
}
    
}
