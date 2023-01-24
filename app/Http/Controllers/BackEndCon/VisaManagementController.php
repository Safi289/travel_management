<?php

namespace App\Http\Controllers\BackEndCon;

use App\CustomerVisa;
use App\CustomerVisaType;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class VisaManagementController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Visa Management',
            'routeNamePrefix' => 'visa-management',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $controllerInfo = $this->controllerInfo;
        $customerVisas = CustomerVisa::with(['visaType'])->get();
        return view('Admin.visa-management.index', compact('controllerInfo', 'customerVisas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        $visaTypes = CustomerVisaType::all();
        $customerVisa = new \App\CustomerVisa();
        return view('Admin.visa-management.form', compact('controllerInfo', 'visaTypes', 'customerVisa'));
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

        $visa = CustomerVisa::create($validatedData);
        if ($visa) {
            Session::flash('success', $this->controllerInfo->title . ' Created Successfully');
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create ' . $this->controllerInfo->title);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return $customerVisa = CustomerVisa::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        $controllerInfo = $this->controllerInfo;
        $visaTypes = CustomerVisaType::all();
        $customerVisa = CustomerVisa::findOrFail($id);
        return view('Admin.visa-management.form', compact('controllerInfo', 'customerVisa', 'visaTypes'));
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

        $customerVisa = CustomerVisa::findOrFail($id)->update($validatedData);
        if ($customerVisa) {
            Session::flash('success', $this->controllerInfo->title . ' Updated Successfully');
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update ' . $this->controllerInfo->title);
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
        $delete = CustomerVisa::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }

    private function dataToValidate()
    {
        return array(
            'customer_name' => 'required',
            'visa_fee' => 'required',
            'service_charge' => 'required',
            'customer_visa_type_id' => 'required',
            'visa_for_country' => 'required',
            'passport_number' => 'required',
            'visa_collect_from' => 'nullable',
        );
    }
}
