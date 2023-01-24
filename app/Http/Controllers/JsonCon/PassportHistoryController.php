<?php

namespace App\Http\Controllers\JsonCon;

use App\CustomerPassport;
use App\Http\Controllers\Controller;
use App\PassportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassportHistoryController extends Controller
{
    /**
     * Get the list of Customers by group id
     *
     * @param $hajj_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPassportStatus(Request $request)
    {
        if (!$request->passport_id){
            return response()->json(['success' => false, 'message' => 'Whoops! Passport ID not Mentioned', 'status' => 400], 200);
        }
        $passportStatuses = PassportStatus::all();
        DB::enableQueryLog();
        $currentPassportStatus = CustomerPassport::with('passportStatuses')->find($request->passport_id);
        $sql = DB::getQueryLog();
//        return $sql;
        if ($passportStatuses->count() > 0) {
            if ($currentPassportStatus->passportCurrentStatus->count() > 0) {
                return response()->json(['success' => true, 'passportStatuses' => $passportStatuses, 'currentStatus' => $currentPassportStatus->passportCurrentStatus->first()->status_id, 'status' => 200], 200);
            } else {
                return response()->json(['success' => true, 'passportStatuses' => $passportStatuses, 'currentStatus' => 0, 'status' => 200], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }

    public function getPassportStatusHistory(Request $request)
    {
        if (!$request->passport_id){
            return response()->json(['success' => false, 'message' => 'Whoops! Passport ID not Mentioned', 'status' => 400], 200);
        }
        $currentPassportStatus = CustomerPassport::with(['passportStatuses' => function ($q) {
            $q->orderBy('pivot_date', 'DESC');
        }])->find($request->passport_id);
        if ($currentPassportStatus->passportStatuses->count() > 0) {
            return response()->json(['success' => true, 'passportStatusHistory' => $currentPassportStatus, 'status' => 200], 200);
        } else {
            return response()->json(['success' => true, 'passportStatusHistory' => $currentPassportStatus, 'status' => 200], 200);
        }
    }
}
