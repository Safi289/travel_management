<?php

namespace App\Http\Controllers\BackEndCon;

use App\Http\Controllers\Controller;
use App\PassportStatus;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class PassportStatusController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Passport Status',
            'routeNamePrefix' => 'passport-status',
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
        $records = PassportStatus::all();
        return view('Admin.passport-status.index', compact('controllerInfo', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        return view('Admin.passport-status.form', compact('controllerInfo'));
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
        $validatedData = Validator::make($request->all(), array(
            'status_name' => 'required',
            'status_id' => 'nullable',
            'serial_no' => 'required',
            'description' => 'nullable',
        ))->validate();

        $data = PassportStatus::create($validatedData);
        if ($data) {
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
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $controllerInfo = $this->controllerInfo;
        $data = PassportStatus::findOrFail($id);
        return view('Admin.passport-status.show', compact('controllerInfo', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $controllerInfo = $this->controllerInfo;
        $data = PassportStatus::findOrFail($id);
        return view('Admin.passport-status.form', compact('controllerInfo', 'data'));
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
        $validatedData = Validator::make($request->all(), array(
            'status_name' => 'required',
            'status_id' => 'nullable',
            'serial_no' => 'required',
            'description' => 'nullable',
        ))->validate();

        $data = PassportStatus::findOrFail($id)->update($validatedData);
        if ($data) {
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = PassportStatus::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
