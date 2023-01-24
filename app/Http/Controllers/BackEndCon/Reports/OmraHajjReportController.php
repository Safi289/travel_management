<?php

namespace App\Http\Controllers\BackEndCon\Reports;

use App\DataTables\Reports\OmraHajjDataTable;
use App\Group;
use App\Hajj;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OmraHajjReportController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Omra Hajj Report',
            'hajj_type_no' => 2,
            'actionButtons' => true,
            'routeNamePrefix' => 'omra-hajj-report',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param OmraHajjDataTable $hajj
     * @param Request $request
     * @return mixed
     */
    public function index(OmraHajjDataTable $hajj, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        $groups = Group::where('group_type', $this->controllerInfo->hajj_type_no)->get();
        return $hajj->setData($request->input())->render('Admin.reports.omra-haji-report.index-dt', compact('controllerInfo', 'groups'));
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
     * @param OmraHajjDataTable $hajj
     * @param Request $request
     * @return mixed
     */
    public function store(OmraHajjDataTable $hajj, Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        $groups = Group::where('group_type', $this->controllerInfo->hajj_type_no)->get();
        return $hajj->setData($request->input())->render('Admin.reports.omra-haji-report.index-dt', compact('controllerInfo', 'groups'));
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
     * @param Request $request
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
