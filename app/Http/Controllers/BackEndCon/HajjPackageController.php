<?php

namespace App\Http\Controllers\BackEndCon;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Package;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class HajjPackageController extends Controller
{
    private $package_type;
    private $package_type_no;
    public function __construct()
    {
        $this->package_type = 'Hajj';
        $this->package_type_no = 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $package_type = $this->package_type;
        $packages = Package::where('package_type', $this->package_type_no)->get();
        return view('Admin.package.index', compact('package_type', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $package_type = $this->package_type;
        $hotels = Hotel::all();
        $vehicles = Vehicle::all();
        return view('Admin.package.form', compact('package_type', 'hotels', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), $this->dataToValidate())->validate();

        $validatedData['package_type'] = $this->package_type_no;
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date']);
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date']);
        $validatedData['makka_arrival_date'] = Carbon::parse($validatedData['makka_arrival_date']);
        $validatedData['madina_arrival_date'] = Carbon::parse($validatedData['madina_arrival_date']);
        $validatedData['makka_ziyarah_date'] = Carbon::parse($validatedData['makka_ziyarah_date']);
        $validatedData['madinaa_ziyarah_date'] = Carbon::parse($validatedData['madinaa_ziyarah_date']);

        $package = Package::create($validatedData);
        if ($package) {
            Session::flash('success', 'Package Created Successfully');
            return redirect()->route('hajj-package.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create Package');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $package = Package::FindOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $package_type = $this->package_type;
        $package = Package::FindOrFail($id);
        $hotels = Hotel::all();
        $vehicles = Vehicle::all();
        return view('Admin.package.form', compact('package_type', 'package', 'hotels', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), $this->dataToValidate())->validate();

        $validatedData['package_type'] = $this->package_type_no;
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date']);
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date']);
        $validatedData['makka_arrival_date'] = Carbon::parse($validatedData['makka_arrival_date']);
        $validatedData['madina_arrival_date'] = Carbon::parse($validatedData['madina_arrival_date']);
        $validatedData['makka_ziyarah_date'] = Carbon::parse($validatedData['makka_ziyarah_date']);
        $validatedData['madinaa_ziyarah_date'] = Carbon::parse($validatedData['madinaa_ziyarah_date']);

        $package = Package::FindOrFail($id)->update($validatedData);
        if ($package) {
            Session::flash('success', 'Package Updated Successfully');
            return redirect()->route('hajj-package.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update Package');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = Package::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Package Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Package Not Deleted'], 200);
        }
    }

    private function dataToValidate()
    {
        return array(
            'package_name' => 'required',
            'pack_code' => 'required',
            'year' => 'required|numeric',
            'hijri' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'no_of_days' => 'required|numeric',
            "makka_arrival_date" => 'nullable',
            "madina_arrival_date" => 'nullable',
            "makka_ziyarah_date" => 'nullable',
            "madinaa_ziyarah_date" => 'nullable',
            'hotel_id' => 'required',
            'vehicle_id' => 'required',
            'total_price' => 'required',
            "package_description" => 'nullable',
            'status' => 'required',
        );
    }
}
