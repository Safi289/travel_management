<?php

namespace App\Http\Controllers\BackEndCon\TicketManagement;

use App\Customer;
use App\Http\Controllers\Controller;
use App\TicketRefund;
use App\TicketSale;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class TicketRefundController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Ticket Refund',
            'routeNamePrefix' => 'ticket-refund',
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
        $records = TicketRefund::with(['ticketSale', 'refundUser'])->get();
        return view('Admin.ticketing-management.ticket-refund.index', compact('controllerInfo', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        $ticketSales = TicketSale::all();
        $customers = Customer::all();
        return view('Admin.ticketing-management.ticket-refund.form', compact('controllerInfo', 'ticketSales', 'customers'));
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
            "ticket_sale_id" => "required",
            "refund_amount" => "required",
            "refund_user_id" => "required",
            "refund_date" => "required",
        ))->validate();

        $validatedData['refund_date'] = Carbon::parse($validatedData['refund_date']);

        $data = TicketRefund::create($validatedData);
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
        $data = TicketRefund::findOrFail($id);
        return view('Admin.ticketing-management.ticket-refund.show', compact('controllerInfo', 'data'));
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
        $data = TicketRefund::findOrFail($id);
        $ticketSales = TicketSale::all();
        $customers = Customer::all();
        return view('Admin.ticketing-management.ticket-refund.form', compact('controllerInfo', 'data', 'ticketSales', 'customers'));
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
            "ticket_sale_id" => "required",
            "refund_amount" => "required",
            "refund_user_id" => "required",
            "refund_date" => "required",
        ))->validate();

        $validatedData['refund_date'] = Carbon::parse($validatedData['refund_date']);

        $data = TicketRefund::findOrFail($id)->update($validatedData);
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
        $delete = TicketRefund::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
