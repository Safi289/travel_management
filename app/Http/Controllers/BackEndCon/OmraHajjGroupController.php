<?php

namespace App\Http\Controllers\BackEndCon;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class OmraHajjGroupController extends Controller
{
    private $title;
    private $group_type;
    private $group_type_no;
    private $routeNamePrefix;

    public function __construct()
    {
        $this->title = 'Omra Hajj Group';
        $this->group_type = 'Omra Hajj';
        $this->group_type_no = 2;
        $this->routeNamePrefix = 'omra-hajj-groups';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $group_type = $this->group_type;
        $groups = Group::withCount('customers')->where('group_type', $this->group_type_no)->get();
        return view('Admin.group.index', compact('groups', 'group_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $group_type = $this->group_type;
        return view('Admin.group.form', compact('group_type'));
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
            'email' => 'nullable|email',
            'address' => 'nullable',
        ))->validate();
        $validatedData['group_type'] = $this->group_type_no;

        $group = Group::create($validatedData);
        $updated_group = $group->update(['group_code' => 'SN-G' . getSixDigitNumber($group->id)]);
        if ($updated_group) {
            Session::flash('success', $this->title . ' Created Successfully');
            return redirect()->route($this->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create ' . $this->title);
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
        $group_type = $this->group_type;
        $group = Group::with('customers.passport')->FindOrFail($id);
        return view('Admin.group.show', compact('group', 'group_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $group_type = $this->group_type;
        $group = Group::FindOrFail($id);
        return view('Admin.group.form', compact('group', 'group_type'));
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
            'management_name' => 'required',
            'contact_no' => 'required',
            'email' => 'nullable|email',
            'address' => 'nullable',
        ))->validate();

        $group = Group::FindOrFail($id)->update($validatedData);
        if ($group) {
            Session::flash('success', $this->title . ' Updated Successfully');
            return redirect()->route($this->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update ' . $this->title);
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
        $delete = Group::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->title . ' Not Deleted'], 200);
        }
    }
}
