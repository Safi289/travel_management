<?php

namespace App\Http\Controllers\BackEndCon\TicketManagement;

use App\Http\Controllers\Controller;
use App\TicketingAirline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class TicketingAirlineController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Ticketing Airlines List',
            'routeNamePrefix' => 'ticketing-airlines',
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
        $ticketingAirlines = TicketingAirline::all();
        return view('Admin.ticketing-management.ticketing-airlines.index', compact('controllerInfo', 'ticketingAirlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        return view('Admin.ticketing-management.ticketing-airlines.form', compact('controllerInfo'));
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
            "airlines_name" => 'required',
            "airlines_code" => 'required',
            "ticketing_serial" => 'required',
            "type" => 'required',
            "status" => 'required',
        ))->validate();

        $airline = TicketingAirline::create($validatedData);
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
        $airline = TicketingAirline::findOrFail($id);
        return view('Admin.ticketing-management.ticketing-airlines.show', compact('controllerInfo', 'airline'));
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
        $airline = TicketingAirline::findOrFail($id);
        return view('Admin.ticketing-management.ticketing-airlines.form', compact('controllerInfo', 'airline'));
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
            "airlines_name" => 'required',
            "airlines_code" => 'required',
            "ticketing_serial" => 'required',
            "type" => 'required',
            "status" => 'required',
        ))->validate();

        $airline = TicketingAirline::findOrFail($id)->update($validatedData);
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
        $delete = TicketingAirline::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
