<?php

namespace App\Http\Controllers\BackEndCon\Accounts;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Deposit;
use App\HajjPayment;
use App\Expense;

class CashInHandController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object) array(
            'title' => 'Cash In Hand',
            'actionButtons' => true,
            'routeNamePrefix' => 'cash-in-hand',
        );

         $this->info = (object) array(
            'title' => 'Daily Cash In Hand',
            'actionButtons' => true,
            'routeNamePrefix' => 'daily-cash-in-hand',
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
        $show_table = false;
        $input = [
          'start_date' => null,
          'end_date' => null,
        ];
        return view('Admin.accounts.cash-in-hand.index', compact('controllerInfo', 'show_table', 'input'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // $start_date = '20201210';
        


        $controllerInfo = $this->controllerInfo;
        $show_table = true;
        $input = $request->input();
        DB::enableQueryLog();
        $left_table = DB::table('hajj_payments')
            ->select('deposit_date', DB::raw("SUM(hajj_payments.amount) AS payment_amount"), 'expense_date', 'expenses.amount AS expense_amount')
            ->join('expenses', 'hajj_payments.deposit_date', '=', 'expenses.expense_date', 'left')
            ->groupBy('deposit_date');
        if (isset($request->start_date) || isset($request->end_date)) {
            $left_table = $left_table->whereBetween('deposit_date', [Carbon::parse($request->start_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]);
        }
        $right_table = DB::table('hajj_payments')
            ->select('deposit_date', 'hajj_payments.amount AS payment_amount', 'expense_date', DB::raw("SUM(expenses.amount) AS expense_amount"))
            ->join('expenses', 'hajj_payments.deposit_date', '=', 'expenses.expense_date', 'right')
            ->groupBy('expense_date');
        if (isset($request->start_date) || isset($request->end_date)) {
            $right_table = $right_table->whereBetween('expense_date', [Carbon::parse($request->start_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]);
        }
        $unionTable = $left_table->union($right_table);
        $balances = DB::query()->fromSub($unionTable, 'a')
            ->select(DB::raw('IFNULL(a.deposit_date, a.expense_date) AS `date`'))
            ->addSelect(DB::raw('IFNULL(a.payment_amount, 0) AS total_deposit'))
            ->addSelect(DB::raw('IFNULL(a.expense_amount, 0) AS total_expenses'))
            ->addSelect(DB::raw('(IFNULL(a.payment_amount, 0) - IFNULL(a.expense_amount, 0)) AS cash_in_hand'))
            ->orderBy('date');
        $total = DB::query()->fromSub($balances, 't')->selectRaw('SUM(t.cash_in_hand) AS total')->first();
        $balances = $balances->get();
        $sql = DB::getQueryLog();






        // $deposit = Deposit::select(DB::raw("SUM(deposits.amount) AS a"), DB::raw("SUM(hajj_payments.amount) AS b"), DB::raw("SUM(expenses.amount) AS c"), 'deposits.deposit_date', 'hajj_payments.deposit_date as payment_date', 'expenses.expense_date')

        //                     ->leftJoin('hajj_payments', 'hajj_payments.deposit_date', '=', 'deposits.deposit_date', 'left')
        //                     ->leftJoin('expenses', 'hajj_payments.deposit_date', '=', 'expenses.expense_date', 'left')

        //                     ->where('deposits.deposit_date', '>=', $start_date)
        //                     ->where('deposits.deposit_date', '<=', $end_date)

        //                     ->where('hajj_payments.deposit_date', '>=', $start_date)
        //                     ->where('hajj_payments.deposit_date', '<=', $end_date)

        //                     ->where('expenses.expense_date', '>=', $start_date)
        //                     ->where('expenses.expense_date', '<=', $end_date)

        //                     ->groupBy('deposits.deposit_date')
        //                     ->orderBy('deposit_date', 'DESC')
        //                     ->get();


        // $x = Deposit::select(DB::raw("SUM(deposits.amount) AS a"))
        //                     ->where('deposits.deposit_date', '=', '20201209')
                            
        //                     ->get();


        // $y = HajjPayment::select(DB::raw("SUM(hajj_payments.amount) AS b"))
        //                     ->where('hajj_payments.deposit_date', '=', '20201209')
                            
        //                     ->get();

        // $range = DB::select("SELECT deposit_date FROM deposits
        //                     WHERE deposit_date>=$start_date AND deposit_date<=$end_date

        //                     union
        //                     SELECT deposit_date FROM hajj_payments
        //                     WHERE deposit_date>=$start_date AND deposit_date<=$end_date

        //                     union
        //                     SELECT expense_date AS deposit_date FROM expenses
        //                     WHERE expense_date>=$start_date AND expense_date<=$end_date

        //                     ORDER BY deposit_date");

        // $deposit_amount = DB::select("SELECT SUM(amount) AS sum_a, deposit_date FROM deposits
        //                               WHERE deposit_date>=$start_date AND deposit_date<=$end_date");

        // $payment_amount = DB::select("SELECT SUM(amount) AS sum_b, deposit_date as payment_date FROM hajj_payments
        //                               WHERE deposit_date>=$start_date AND deposit_date<=$end_date");

        // $expense_amount = DB::select("SELECT SUM(amount) AS sum_c, expense_date FROM expenses
        //                               WHERE expense_date>=$start_date AND expense_date<=$end_date");
        // return $deposit; exit();
        // foreach ($deposit as $key) {
        //     return $key->deposit_date;
        // // }
        // $total_deposit = Deposit::where('deposit_date', '>=', $start_date)
        //                         ->where('deposit_date', '<=', $end_date)->sum('amount');

        // $total_payment = HajjPayment::where('deposit_date', '>=', $start_date)
        //                         ->where('deposit_date', '<=', $end_date)->sum('amount');

        // $total_expense = Expense::where('expense_date', '>=', $start_date)
        //                         ->where('expense_date', '<=', $end_date)->sum('amount');
       
        // foreach ($range as $row) {
        //     // return $row->deposit_date;
        //     $a1 = Deposit::where('deposit_date', '=', $row->deposit_date)->select(DB::raw("SUM(amount) as a", 'deposit_date'))->first();
            
        //     $b1 = HajjPayment::where('deposit_date', '=', $row->deposit_date)->select(DB::raw("SUM(amount) as b", 'deposit_date'))->get();
        //     $c1 = Expense::where('expense_date', '=', $row->deposit_date)->select(DB::raw("SUM(amount) as c", 'expense_date'))->get();
        // }

        // $cards = Deposit::select([\DB::raw('SUM(deposits.amount) AS deposit_amount'),
        //                            \DB::raw('SUM(hajj_payments.amount) AS payment_amount'),
        //                             \DB::raw('SUM(expenses.amount) AS expense_amount')])
        //                     ->join('hajj_payments', 'hajj_payments.deposit_date', '=', 'deposits.deposit_date', 'left')
        //                     ->join('expenses', 'hajj_payments.deposit_date', '=', 'expenses.expense_date', 'left')

        //                     ->orWhere('deposits.deposit_date', '>=', $start_date)
        //                     ->orWhere('deposits.deposit_date', '<=', $end_date)

        //                     ->orWhere('hajj_payments.deposit_date', '>=', $start_date)
        //                     ->orWhere('hajj_payments.deposit_date', '<=', $end_date)

        //                     ->orWhere('expenses.expense_date', '>=', $start_date)
        //                     ->orWhere('expenses.expense_date', '<=', $end_date)

                          
        //                     ->groupBy('hajj_payments.deposit_date')
        //                     ->groupBy('deposits.deposit_date')
        //                     ->groupBy('expenses.expense_date')
    
        //                     ->orderBy('hajj_payments.deposit_date', 'DESC')

        //                     ->get();

        // $a = DB::table('deposits')->select('deposit_date')->get();
        // $b = DB::table('hajj_payments')->select('deposit_date')->get();
        
        // $c = DB::table('expenses')->select('expense_date as deposit_date')->get();
        // $d = $a->union($b);
        // $e = $c->union($d);


        // exit();
        // return $left_table; exit();
        return view('Admin.accounts.cash-in-hand.index', compact('controllerInfo', 'balances', 'total', 'show_table', 'input', 'sql'));
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
        //
    }

    public function deposit_expense()
    {
        $controllerInfo = $this->info;
        $show_table = false;
        $input = [
          'start_date' => null,
          'end_date' => null,
        ];
        return view('Admin.accounts.cash-in-hand.index_update', compact('controllerInfo', 'show_table', 'input'));
    }

    public function deposit_expense_stor(Request $request)
    {
        // return $request; exit();
        // $start_date = '20201202';
        $start_date = date('Ymd', strtotime($request->start_date));
        // $end_date = date('Ymd', strtotime($request->end_date));
        $controllerInfo = $this->info;
        $show_table = true;
        $input = $request->input();
        DB::enableQueryLog();
        $left_table = DB::table('deposits')
            ->select('deposit_date', DB::raw("SUM(deposits.amount) AS payment_amount"), 'expense_date', 'expenses.amount AS expense_amount')
            ->join('expenses', 'deposits.deposit_date', '=', 'expenses.expense_date', 'left')
            ->groupBy('deposit_date');
        if (isset($request->start_date)) {
            $left_table = $left_table->where('deposit_date', [Carbon::parse($request->start_date)->format('Y-m-d')]);
        }
        $right_table = DB::table('deposits')
            ->select('deposit_date', 'deposits.amount AS payment_amount', 'expense_date', DB::raw("SUM(expenses.amount) AS expense_amount"))
            ->join('expenses', 'deposits.deposit_date', '=', 'expenses.expense_date', 'right')
            ->groupBy('expense_date');
        if (isset($request->start_date)) {
            $right_table = $right_table->where('expense_date', [Carbon::parse($request->start_date)->format('Y-m-d')]);
        }
        $unionTable = $left_table->union($right_table);
        $balances = DB::query()->fromSub($unionTable, 'a')
            ->select(DB::raw('IFNULL(a.deposit_date, a.expense_date) AS `date`'))
            ->addSelect(DB::raw('IFNULL(a.payment_amount, 0) AS total_deposit'))
            ->addSelect(DB::raw('IFNULL(a.expense_amount, 0) AS total_expenses'))
            ->addSelect(DB::raw('(IFNULL(a.payment_amount, 0) - IFNULL(a.expense_amount, 0)) AS cash_in_hand'))
            ->orderBy('date');
        $total = DB::query()->fromSub($balances, 't')->selectRaw('SUM(t.cash_in_hand) AS total')->first();
        $balances = $balances->get();
        $sql = DB::getQueryLog();

        $dep = DB::table('deposits')
                        
                        ->where('deposits.deposit_date', '=', $start_date)
                        ->sum('deposits.amount');

        $exp = DB::table('expenses')
                        
                        ->where('expenses.expense_date', '=', $start_date)
                        ->sum('expenses.amount');

        // return $exp; exit();
        return view('Admin.accounts.cash-in-hand.index_update', compact('start_date','dep','exp','controllerInfo', 'balances', 'total', 'show_table', 'input', 'sql'));
    }
}
