<?php

namespace App\Http\Controllers\JsonCon;

use App\CustomerPassport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPassportController extends Controller
{
    /**
     * Check whether the passport number already registered
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isRegisteredPassport(Request $request)
    {
        if (!$request->passport_no) {
            return response()->json(['success' => false, 'message' => 'Whoops! Passport Number not Mentioned', 'status' => 400], 200);
        }
        $isRegisteredPassport = CustomerPassport::where('passport_no', $request->passport_no)->get();
        if ($isRegisteredPassport->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Passport Already registered', 'status' => 400], 200);
        } else {
            return response()->json(['success' => true, 'message' => 'This is a new passport', 'status' => 200], 200);
        }
    }
}
