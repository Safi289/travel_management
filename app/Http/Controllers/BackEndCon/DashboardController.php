<?php

namespace App\Http\Controllers\BackEndCon;

use App\Customer;
use App\Group;
use App\Hajj;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $customer_count = Customer::all()->count();
        $haji_count = Hajj::where('type', 1)->get()->count();
        $omra_haji_count = Hajj::where('type', 2)->get()->count();
        $group_count = Group::all()->count();
        $totalCounts = (object) array(
            'customer_count' => $customer_count,
            'haji_count' => $haji_count,
            'omra_haji_count' => $omra_haji_count,
            'agent_group_count' => $group_count,
        );
        return view('Admin.dashboard', compact('totalCounts'));
    }
}
