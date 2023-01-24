<?php

namespace App\Http\Controllers\BackEndCon;

use App\Customer;
use App\Group;
use App\Http\Controllers\Controller;
use App\Services\SmsSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SmsSenderController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Send SMS',
            'actionButtons' => true,
            'routeNamePrefix' => 'sms-sending-system',
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
        $groups = Group::all();
        return view('Admin.sms.form', compact('controllerInfo', 'groups'));
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
     */
    public function store(Request $request)
    {
        $smsSender = new SmsSender();
        $customers = Customer::select('mobile');
        if (isset($request->year) && $request->service_type_id != 0) {
            $customers->with(['hajj' => function ($q) use ($request) {
                $q->where('type', $request->service_type_id);
            }])->whereHas('hajj', function ($q) use ($request) {
                $q->where('type', $request->service_type_id);
            });
        }
        if ($request->group) {
            $customers->where('group_id', $request->group);
        }
        $customers = $customers->get();
        if ($customers->count() > 0) {
            foreach ($customers as $customer) {
                $res = $smsSender->sendSMS($customer->mobile, $request->message);
            }
        }
        if ($customers) {
            Session::flash('success', 'SMS Sent Successfully');
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Send SMS');
            return redirect()->back()->withInput();
        }
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
        $delete = Customer::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
