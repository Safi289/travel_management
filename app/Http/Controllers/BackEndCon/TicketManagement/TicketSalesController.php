<?php

namespace App\Http\Controllers\BackEndCon\TicketManagement;

use App\Http\Controllers\Controller;
use App\TicketingAirline;
use App\TicketSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class TicketSalesController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Ticket Sales',
            'routeNamePrefix' => 'ticket-sales',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    { 
        // echo "string"; exit();
        $controllerInfo = $this->controllerInfo;
        $ticketSales = TicketSale::with(['airline'])->get();
        return view('Admin.ticketing-management.ticket-sales.index', compact('controllerInfo', 'ticketSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // echo "string"; exit();
        $controllerInfo = $this->controllerInfo;
        $ticketingAirlines = TicketingAirline::all();
        return view('Admin.ticketing-management.ticket-sales.form', compact('controllerInfo', 'ticketingAirlines'));
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
        // return $request; exit();
        $validatedData = Validator::make($request->all(), array(
            "ticketing_airline_id" => "required",
            "ticket_no" => "required|max:9",
            "passenger_name" => "required",
            "sector" => "required",
            "flight_date" => "required",
            "class" => "required",
            "pax_type" => "required",
            "sales_date" => "required",
            // "amount_sales" => "required",
            "fare_amount" => "required",
            "commission" => "required",
            "farecommission" => "required",
            "tax" => "required",
            "ait" => "required",
            "fare_tax" => "required",
            "service_charge" => "required",
            "total" => "required",

            "invoice_no" => "required",
            "sales_user_address" => "nullable",
        ))->validate();

        $validatedData['flight_date'] = Carbon::parse($validatedData['flight_date']);
        $validatedData['sales_date'] = Carbon::parse($validatedData['sales_date']);
        $validatedData['sales_by'] = Auth::id();

        $airline = TicketSale::create($validatedData);
        if ($airline) {
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $controllerInfo = $this->controllerInfo;
        $airline = TicketSale::findOrFail($id);
        return view('Admin.ticketing-management.ticket-sales.show', compact('controllerInfo', 'airline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $controllerInfo = $this->controllerInfo;
        $ticketSale = TicketSale::findOrFail($id);
        $ticketingAirlines = TicketingAirline::all();
        return view('Admin.ticketing-management.ticket-sales.form', compact('controllerInfo', 'ticketSale', 'ticketingAirlines'));
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
            "ticketing_airline_id" => "required",
            "ticket_no" => "required|max:9",
            "passenger_name" => "required",
            "sector" => "required",
            "flight_date" => "required",
            "class" => "required",
            "pax_type" => "required",
            "sales_date" => "required",
            // "amount_sales" => "required",
            "fare_amount" => "required",
            "commission" => "required",
            "farecommission" => "required",
            "tax" => "required",
            "ait" => "required",
            "fare_tax" => "required",
            "service_charge" => "required",
            "total" => "required",

            "invoice_no" => "required",
            "sales_user_address" => "nullable",
        ))->validate();

        $validatedData['flight_date'] = Carbon::parse($validatedData['flight_date']);
        $validatedData['sales_date'] = Carbon::parse($validatedData['sales_date']);

        $airline = TicketSale::findOrFail($id)->update($validatedData);
        if ($airline) {
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
        $delete = TicketSale::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
