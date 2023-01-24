<?php

namespace App\Http\Controllers\JsonCon;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Get the list of upazilas from district id
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPackageInformation($id)
    {
        $package = Package::find($id);
        if ($package->count() > 0) {
            return response()->json(['success' => true, 'data' => $package, 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Data not found', 'status' => 400], 200);
        }
    }
}
