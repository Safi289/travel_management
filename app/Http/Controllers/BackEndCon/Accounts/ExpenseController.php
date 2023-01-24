<?php

namespace App\Http\Controllers\BackEndCon\Accounts;

use App\Expense;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ExpenseController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Expense',
            'routeNamePrefix' => 'expense-list',
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
        $expenses = Expense::with('category')->get();
        return view('Admin.accounts.expense.index', compact('controllerInfo', 'expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $controllerInfo = $this->controllerInfo;
        $categories = ExpenseCategory::all();
        return view('Admin.accounts.expense.form', compact('controllerInfo', 'categories'));
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
            'expense_title' => 'required',
            'expense_by' => 'required',
            'expense_category_id' => 'required|numeric',
            'description' => 'nullable',
            'expense_date' => 'required',
            'amount' => 'required|numeric',
        ))->validate();
        $validatedData['expense_date'] = Carbon::parse($validatedData['expense_date'])->format('Y-m-d H:i:s');

        $expense = Expense::create($validatedData);
        if ($expense) {
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
        $expense = Expense::with('category')->FindOrFail($id);
        return view('Admin.accounts.expense.show', compact('controllerInfo', 'expense'));
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
        $expense = Expense::FindOrFail($id);
        $categories = ExpenseCategory::all();
        return view('Admin.accounts.expense.form', compact('controllerInfo', 'expense', 'categories'));
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
            'expense_title' => 'required',
            'expense_by' => 'required',
            'expense_category_id' => 'required|numeric',
            'description' => 'nullable',
            'expense_date' => 'required',
            'amount' => 'required|numeric',
        ))->validate();
        $validatedData['expense_date'] = Carbon::parse($validatedData['expense_date'])->format('Y-m-d H:i:s');

        $expense = Expense::FindOrFail($id)->update($validatedData);
        if ($expense) {
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
        $delete = Expense::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }
}
