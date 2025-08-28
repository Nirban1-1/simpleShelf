<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class MembershipController extends Controller
{
    // Add this method
    public function index()
    {
        // Fetch all membership plans
        $plans = Membership::all();

        // Return a view (create membership/plans.blade.php)
        return view('membership.plans', compact('plans'));
    }
}
