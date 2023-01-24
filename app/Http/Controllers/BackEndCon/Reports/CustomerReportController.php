<?php

namespace App\Http\Controllers\BackEndCon\Reports;

use App\Customer;
use App\DataTables\Reports\CustomersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Customer Report',
            'actionButtons' => true,
            'routeNamePrefix' => 'customer-report',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param CustomersDataTable $customers
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CustomersDataTable $customers, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        return $customers->setData($request->input())->render('Admin.reports.customer-report.index-dt', compact('controllerInfo'));
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
     * @param CustomersDataTable $customers
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomersDataTable $customers, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        return $customers->setData($request->input())->render('Admin.reports.customer-report.index-dt', compact('controllerInfo'));
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
