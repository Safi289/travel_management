<?php

namespace App\Http\Controllers\BackEndCon\Accounts;

use App\HajjPayment;
use App\Http\Controllers\Controller;
use App\Hajj;
use App\Bank;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class DepositController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Deposit',
            'actionButtons' => true,
            'routeNamePrefix' => 'deposit-list',
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
        $hajis = Hajj::select('hajjs.*')->with(['customer'])
            ->addSelect(DB::raw('SUM(hajj_payments.amount) as paid_amount'))
            ->addSelect(DB::raw('CAST(packages.total_price - SUM(hajj_payments.amount) AS DECIMAL(10,2)) AS due_amount'))
            ->join('hajj_payments', 'hajjs.id', '=', 'hajj_payments.hajj_id', 'left')
            ->join('packages', 'hajjs.package_id', '=', 'packages.id', 'left')
            ->groupBy('hajjs.id')
            ->groupBy('hajj_payments.hajj_id')->get();
        return view('Admin.accounts.deposit.index', compact('controllerInfo', 'hajis'));
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


    public function addPayment($hajj_id)
    {
        $controllerInfo = $this->controllerInfo;
        $haji = Hajj::with('customer')->findOrFail($hajj_id);
        $banks = Bank::all();
        return view('Admin.accounts.deposit.form', compact('controllerInfo', 'haji'),[
            'banks'=>$banks
        ]);
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
            'hajj_id' => 'required|numeric',
            // 'voucher_name' => 'required|unique:hajj_payments',
            'type' => 'required|numeric',
            'depositor_name' => 'required',
            'bank_name' => 'nullable',
            'bank_branch_name' => 'nullable',
            'cheque_number' => 'nullable',
            'deposit_date' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required|numeric',
        ))->validate();

        $payment = HajjPayment::create($validatedData);
        if ($payment) {
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
        // echo "string"; exit();
        $controllerInfo = $this->controllerInfo;
        $banks = Bank::all();
        $haji = Hajj::with('payments')->FindOrFail($id);
        return view('Admin.accounts.deposit.show', compact('controllerInfo', 'haji', 'banks'));
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
        $banks = Bank::all();
        // $bank1 = Bank::where('b_id', '=', );
        $hajj_payment = HajjPayment::FindOrFail($id);
        $haji = Hajj::with(['customer', 'payments'])->whereHas('payments', function ($q) use ($hajj_payment) {
            $q->where('hajj_id', $hajj_payment->hajj_id);
        })->first();
        return view('Admin.accounts.deposit.form', compact('banks','controllerInfo', 'hajj_payment', 'haji'));
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
            'hajj_id' => 'required|numeric',
            // 'voucher_name' => 'required|unique:hajj_payments',
            'type' => 'required|numeric',
            'depositor_name' => 'required',
            'bank_name' => 'nullable',
            'bank_branch_name' => 'nullable',
            'cheque_number' => 'nullable',
            'deposit_date' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required|numeric',
        ))->validate();

        $payment = HajjPayment::FindOrFail($id)->update($validatedData);
        if ($payment) {
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
        $delete = Hajj::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => $this->controllerInfo->title . ' Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! ' . $this->controllerInfo->title . ' Not Deleted'], 200);
        }
    }

    /**
     * Change the payment status of Hajj
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePaymentStatus(Request $request)
    {
        $validatedData = Validator::make($request->all(), array(
            'id' => 'required|numeric',
            'payment_status' => 'required|numeric',
        ))->validate();
        $id = $validatedData['id'];
        unset($validatedData['id']);

        $hajj = Hajj::findOrFail($id)->update($validatedData);
        if ($hajj) {
            Session::flash('success', $this->controllerInfo->title . ' Updated Successfully');
            return redirect()->route($this->controllerInfo->routeNamePrefix . '.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update ' . $this->controllerInfo->title);
            return redirect()->back()->withInput();
        }
    }

    /**
     * deposit Details view Only
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function depositDetails($id)
    {
        $this->controllerInfo->actionButtons = false;
        $this->controllerInfo->activeMenu = false;
        $controllerInfo = $this->controllerInfo;
        $haji = Hajj::with('payments')->FindOrFail($id);
        return view('Admin.accounts.deposit.show', compact('controllerInfo', 'haji'));
    }

    public function printReceipt($id)
    {
        $controllerInfo = $this->controllerInfo;
        $payment = HajjPayment::with(['hajj'])->find($id);
        return view('Admin.accounts.deposit.receipt', compact('controllerInfo', 'payment'));
    }
}
