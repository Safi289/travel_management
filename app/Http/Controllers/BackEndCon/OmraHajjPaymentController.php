<?php

namespace App\Http\Controllers\BackEndCon;

use App\HajjPayment;
use App\Http\Controllers\Controller;
use App\Hajj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class OmraHajjPaymentController extends Controller
{
    private $hajj_type;
    private $hajj_type_no;

    public function __construct()
    {
        $this->hajj_type = 'Omra Haji';
        $this->hajj_type_no = 2;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hajj_type = $this->hajj_type;
        $payments = HajjPayment::with(['hajj' => function ($q) {
            $q->with('customer');
        }])->whereHas('hajj', function ($q) {
            $q->where('type', $this->hajj_type_no);
        })->get();
        return view('Admin.hajj-payment.index', compact('hajj_type', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($hajj_id)
    {
        $hajj_type = $this->hajj_type;
        $haji = Hajj::with('customer')->findOrFail($hajj_id);
        return view('Admin.hajj-payment.form', compact('hajj_type', 'haji'));
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
            'voucher_name' => 'required|unique:hajj_payments',
            'type' => 'required|numeric',
            'depositor_name' => 'required',
            'deposit_date' => 'required',
            'amount' => 'required',
            'status' => 'required|numeric',
        ))->validate();

        $data = $request->all();
        $payment = HajjPayment::create($data);
        if ($payment) {
            Session::flash('success', 'Payment Added Successfully');
            return redirect()->route('omra-hajj-payment.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create Payment');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $haji = Hajj::FindOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $hajj_type = $this->hajj_type;
        $hajj_payment = HajjPayment::FindOrFail($id);
        $haji = Hajj::with(['customer', 'payments'])->whereHas('payments', function ($q) use ($hajj_payment) {
            $q->where('hajj_id', $hajj_payment->hajj_id);
        })->first();
        return view('Admin.hajj-payment.form', compact('hajj_type', 'haji', 'hajj_payment'));
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
            'voucher_name' => 'required|unique:hajj_payments,voucher_name, ' . $id . ',id',
            'type' => 'required|numeric',
            'depositor_name' => 'required',
            'deposit_date' => 'required',
            'amount' => 'required',
            'status' => 'required|numeric',
        ))->validate();

        $data = $request->all();
        $payment = HajjPayment::FindOrFail($id)->update($data);
        if ($payment) {
            Session::flash('success', 'Payment Updated Successfully');
            return redirect()->route('omra-hajj-payment.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update Payment');
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
        $delete = HajjPayment::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Payment Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Payment Not Deleted'], 200);
        }
    }
}
