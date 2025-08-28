<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership; //
use App\Models\User;
class MembershipController extends Controller
{
    public function index()
    {
        $plans = Membership::all();  // fetch plans
        return view('membership.plans', compact('plans'));
    }

    public function subscribe(Request $request, $id)
    {
        $user = auth()->user();
        $plan = Membership::findOrFail($id);

        // Add subscription logic
        $user->memberships()->attach($plan->id, [
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
            'status' => 'active',
        ]);

        return redirect()->route('orders.index')->with('success', 'Membership activated!');
    }
}
