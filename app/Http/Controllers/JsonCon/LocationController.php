<?php

namespace App\Http\Controllers\JsonCon;

use App\Http\Controllers\Controller;
use App\Upazila;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Get the list of upazilas from district id
     *
     * @param int $district
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUpazilasFromDistrict($district)
    {
        $upazilas = Upazila::where('district_id', $district)->orderBy('name')->get();
        if ($upazilas->count() > 0) {
            return response()->json(['success' => true, 'data' => $upazilas, 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }
}
