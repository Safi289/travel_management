<?php

namespace App\Http\Controllers\BackEndCon\Reports;

use App\Customer;
use App\DataTables\Reports\HajjDataTable;
use App\Group;
use App\Hajj;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HajjReportController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Hajj Report',
            'hajj_type_no' => 1,
            'actionButtons' => true,
            'routeNamePrefix' => 'hajj-report',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param HajjDataTable $hajj
     * @param Request $request
     * @return mixed
     */
    public function index(HajjDataTable $hajj, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        $groups = Group::where('group_type', $this->controllerInfo->hajj_type_no)->get();
        return $hajj->setData($request->input())->render('Admin.reports.haji-report.index', compact('controllerInfo', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        DB::enableQueryLog();
        $model = Hajj::with(['customer', 'package']);
        $data = $model->addSelect(['paid_amount' => function ($q) {
            $q->select(DB::raw('SUM(hajj_payments.amount) as paid_amount'))
                ->from('hajj_payments')
                ->whereColumn('hajj_id', 'hajjs.id')
                ->groupBy('hajj_payments.hajj_id');
        }/*, 'due_amount' => function ($q) {
            $q->select(DB::raw('CAST(packages.total_price - SUM(hajj_payments.amount) AS DECIMAL(10,2)) AS due_amount'))
                ->from('hajj_payments')
                ->whereColumn('hajj_id', 'hajjs.id')
                ->groupBy('hajj_payments.hajj_id');
        }*/])
            ->join('packages', 'hajjs.package_id', '=', 'packages.id', 'left')
            ->where('hajjs.type', 1)->get();
        $sql = DB::getQueryLog();
        return response()->json(['data' => $data, 'sql' => $sql]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HajjDataTable $hajj
     * @param Request $request
     * @return mixed
     */
    public function store(HajjDataTable $hajj, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        $groups = Group::where('group_type', $this->controllerInfo->hajj_type_no)->get();
        return $hajj->setData($request->input())->render('Admin.reports.haji-report.index', compact('controllerInfo', 'groups'));
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
        $delete = Hajj::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
