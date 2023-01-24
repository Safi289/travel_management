<?php

namespace App\Http\Controllers\BackEndCon;

use App\Hotel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class HotelRateController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Hotel Rate',
            'routeNamePrefix' => 'hotel-rate',
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
        $hotels = Hotel::all();
        return view('Admin.hotel-rate.index', compact('controllerInfo', 'hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        return view('Admin.hotel-rate.form', compact('controllerInfo'));
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
            'hotel_name' => 'required',
            'hotel_area' => 'nullable',
            'no_of_rooms' => 'nullable',
            'no_of_hajis' => 'nullable',
            'staying_start_date' => 'nullable',
            'staying_end_date' => 'nullable',
            'cost' => 'required',
        ))->validate();

        $validatedData['staying_start_date'] = Carbon::parse($validatedData['staying_start_date'])->format('Y-m-d');
        $validatedData['staying_end_date'] = Carbon::parse($validatedData['staying_end_date'])->format('Y-m-d');

        $hotel = Hotel::create($validatedData);
        if ($hotel) {
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
        $hotel = Hotel::with('customers.passport')->FindOrFail($id);
        return view('Admin.hotel-rate.show', compact('controllerInfo', 'hotel'));
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
        $hotel = Hotel::FindOrFail($id);
        return view('Admin.hotel-rate.form', compact('controllerInfo', 'hotel'));
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
            'hotel_name' => 'required',
            'hotel_area' => 'nullable',
            'no_of_rooms' => 'nullable',
            'no_of_hajis' => 'nullable',
            'staying_start_date' => 'nullable',
            'staying_end_date' => 'nullable',
            'cost' => 'required',
        ))->validate();

        $validatedData['staying_start_date'] = Carbon::parse($validatedData['staying_start_date'])->format('Y-m-d');
        $validatedData['staying_end_date'] = Carbon::parse($validatedData['staying_end_date'])->format('Y-m-d');

        $hotel = Hotel::findOrFail($id)->update($validatedData);
        if ($hotel) {
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
        $delete = Hotel::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
