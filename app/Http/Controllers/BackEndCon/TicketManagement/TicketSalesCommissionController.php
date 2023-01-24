<?php

namespace App\Http\Controllers\BackEndCon\TicketManagement;

use App\Http\Controllers\Controller;
use App\TicketingAirline;
use App\TicketSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class TicketSalesCommissionController extends Controller
{
    private $controllerInfo;

    public function __construct()
    {
        $this->controllerInfo = (object)array(
            'title' => 'Ticket Sales Commission',
            'routeNamePrefix' => 'ticket-sales-commission',
        );
    }

    /**
     * @param array $filter
     * @return \Illuminate\Database\Query\Builder
     */
    private function calculateSalesCommissionQuery($filter = [])
    {
        $taxPercentage = 15;
        $salesCommissionPercentage = 7;
        $AITChargePercentage = 3;
        $query = TicketSale::addSelect(['tax_amount' => function($q) use ($taxPercentage) {
            $q->selectRaw('CAST((amount_sales*'.($taxPercentage/100).') AS DECIMAL(10,2)) AS tax_amount');
        }, 'sales_commission' => function($q) use ($salesCommissionPercentage) {
            $q->selectRaw('CAST((amount_sales*'.($salesCommissionPercentage/100).') AS DECIMAL(10,2)) AS sales_commission');
        }, 'ait_charge' => function($q) use ($AITChargePercentage) {
            $q->selectRaw('CAST(((tax_amount+sales_commission+amount_sales)*'.($AITChargePercentage/100).') AS DECIMAL(10,2)) AS ait_charge');
        }]);
        if (isset($filter['start_date'])) {
            $query->where('sales_date', '>=', Carbon::parse($filter['start_date'])->startOfDay());
        }
        if (isset($filter['end_date'])) {
            $query->where('sales_date', '<', Carbon::parse($filter['end_date'])->endOfDay());
        }
        return $query;
    }

    private function getSalesCommissionSum($filter = [])
    {
        $query = DB::table(DB::raw("({$this->calculateSalesCommissionQuery($filter)->toSql()}) as commission_query"))
            ->mergeBindings($this->calculateSalesCommissionQuery($filter)->getQuery());
        $query->addSelect(DB::raw('SUM(tax_amount) AS sum_tax_amount'));
        $query->addSelect(DB::raw('SUM(sales_commission) AS sum_sales_commission'));
        $query->addSelect(DB::raw('SUM(ait_charge) AS sum_ait_charge'));
        return $query->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $controllerInfo = $this->controllerInfo;
        $perPage = $request->input('perPage');
        $filter = [];
        if ($request->input('start_date')) {
            $filter['start_date'] = $request->input('start_date');
        } else {
            $filter['start_date'] = Carbon::now();
        }
        if ($request->input('end_date')) {
            $filter['end_date'] = $request->input('end_date');
        } else {
            $filter['start_date'] = Carbon::now();
        }
        $ticketSales = $this->calculateSalesCommissionQuery($filter)->paginate($perPage);
        $ticketSalesSum = $this->getSalesCommissionSum($filter);
        return view('Admin.ticketing-management.ticket-sales-commission.index', compact('controllerInfo', 'ticketSales', 'ticketSalesSum'));
    }
}
