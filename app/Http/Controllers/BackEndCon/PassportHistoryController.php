<?php

namespace App\Http\Controllers\BackEndCon;

use App\CustomerPassport;
use App\Http\Controllers\Controller;
use App\PassportHistory;
use App\PassportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PassportHistoryController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Passport History',
            'routeNamePrefix' => 'passport-history',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $controllerInfo = $this->controllerInfo;
        $passports = CustomerPassport::with(['passportStatuses' => function ($q) {
            $q->orderBy('date', 'DESC');
        }])->get();
//        return $passports;
        return view('Admin.passport-history.index', compact('controllerInfo', 'passports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
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
        //
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

    public function changeStatus(Request $request)
    {
        $validatedData = Validator::make($request->all(), array(
            'passport_id' => 'required|numeric',
            'passport_status_id' => 'required|numeric|not_in:0',
        ))->validate();

        $passportHistory = PassportHistory::create($validatedData);
        if ($passportHistory) {
            Session::flash('success', $this->controllerInfo->title . ' Created Successfully');
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create ' . $this->controllerInfo->title);
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        }
    }

    public function printReceipt($id)
    {
        $passport = CustomerPassport::with(['passportStatuses' => function ($q) {
            $q->orderBy('date', 'DESC')->first();
        }])->find($id);
        return view('Admin.passport-history.receipt', compact('passport'));
    }
}
