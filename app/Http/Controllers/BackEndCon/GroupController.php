<?php

namespace App\Http\Controllers\BackEndCon;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = Group::withCount('customers')->get();
        return view('Admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.group.form');
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
            'group_name' => 'required',
            'leader_name' => 'required',
            'management_type' => 'required',
            'management_name' => 'required',
            'contact_no' => 'required',
        ))->validate();

        $group = Group::create($request->all());
        $updated_group = $group->update(['group_code' => 'SN-G' . getSixDigitNumber($group->id)]);
        if ($updated_group) {
            Session::flash('success', 'Group Created Successfully');
            return redirect()->route('groups.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create Group');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $group = Group::with('customers.passport')->FindOrFail($id);
        $group_customer = Group::join('customers','customers.group_id', '=', 'groups.id')
                                ->join('upazilas', 'upazilas.id', '=', 'customers.current_police_station')
                                ->where('groups.id', '=', $id)
                                ->get();               
        // return $grpup_customer; exit();
        return view('Admin.group.show', compact('group', 'group_customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $group = Group::FindOrFail($id);
        return view('Admin.group.form', compact('group'));
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
            'group_name' => 'required',
            'leader_name' => 'required',
            'management_type' => 'required',
            'contact_no' => 'required',
        ))->validate();

        $group = Group::FindOrFail($id)->update($request->all());
        if ($group) {
            Session::flash('success', 'Group Updated Successfully');
            return redirect()->route('groups.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update Group');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = Group::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Group Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Group Not Deleted'], 200);
        }
    }
}
