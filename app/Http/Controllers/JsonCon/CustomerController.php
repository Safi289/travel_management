<?php

namespace App\Http\Controllers\JsonCon;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Get the list of Customers by group id
     *
     * @param $group_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomerByGroup($group_id)
    {
        $customers = Customer::where('group_id', $group_id)->orderBy('given_name')->get();
        if ($customers->count() > 0) {
            return response()->json(['success' => true, 'data' => $customers, 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }

    public function updateNote($customer, Request $request)
    {
        $customer = Customer::find($customer);
        if ($customer) {
            if ($customer->update(['notes' => $request->notes])) {
                return response()->json(['success' => true, 'message' => 'Notes Updated Successfully', 'status' => 200], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Whoops! Failed to update notes', 'status' => 400], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }

    public function getCustomerById($id)
    {
        $customer = Customer::with('group')->find($id);
        if ($customer->count() > 0) {
            return response()->json(['success' => true, 'data' => $customer, 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }
}
