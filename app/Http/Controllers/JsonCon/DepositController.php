<?php

namespace App\Http\Controllers\JsonCon;

use App\Hajj;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Get the list of Customers by group id
     *
     * @param $hajj_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaymentStatus($hajj_id)
    {
        if (!$hajj_id){
            return response()->json(['success' => false, 'message' => 'Whoops! Hajj ID not Mentioned', 'status' => 400], 200);
        }
        $haji = Hajj::select('hajjs.*')
            ->addSelect(DB::raw('SUM(hajj_payments.amount) as paid_amount'))
            ->addSelect(DB::raw('CAST(packages.total_price - SUM(hajj_payments.amount) AS DECIMAL(10,2)) AS due_amount'))
            ->join('hajj_payments', 'hajjs.id', '=', 'hajj_payments.hajj_id', 'left')
            ->join('packages', 'hajjs.package_id', '=', 'packages.id', 'left')
            ->groupBy('hajj_payments.hajj_id')
            ->find($hajj_id);
        if ($haji->count() > 0) {
            if ($haji->due_amount > 0 || $haji->paid_amount <= 0 || !$haji->paid_amount) {
                return response()->json(['success' => true, 'data' => false, 'due' => $haji->due_amount, 'status' => 200], 200);
            } else {
                return response()->json(['success' => true, 'data' => $haji->payment_status, 'status' => 200], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }

    public function getDepositList(Request $request)
    {
        if (!$request->hajj_id){
            return response()->json(['success' => false, 'message' => 'Whoops! Hajj ID not Mentioned', 'status' => 400], 200);
        }
        $haji = Hajj::with(['customer', 'payments'])->find($request->hajj_id);
        if ($haji->count() > 0) {
            return response()->json(['success' => true, 'data' => $haji, 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }
}
