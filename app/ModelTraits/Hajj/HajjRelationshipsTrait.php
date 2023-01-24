<?php


namespace App\ModelTraits\Hajj;


use Illuminate\Support\Facades\DB;

trait HajjRelationshipsTrait
{

    public function paidAmount()
    {
        return $this->payments()
            ->select('hajj_id', DB::raw('SUM(hajj_payments.amount) as paid_amount'))
            ->groupBy('hajj_id');
    }

    public function packagePrice()
    {
        return $this->package()
            ->selectRaw('packages.id, CAST(packages.total_price AS DECIMAL(10,2)) package_price');
    }

    public function remainingReport()
    {
        return ($this->packagePrice()->package_price - $this->paidAmount()->paid_amount);
    }
}
