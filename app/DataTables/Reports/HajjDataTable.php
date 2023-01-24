<?php

namespace App\DataTables\Reports;

use App\CustomerPassport;
use App\Hajj;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HajjDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $data;

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('customer_full_name', function ($query) {
                if ($query->customer) {
                    return $query->customer->full_name;
                } else {
                    return "";
                }
            })
            ->addColumn('formatted_start_date', function ($query) {
                return $query->start_date ? Carbon::parse($query->start_date)->format('d-m-Y') : '';
            })
            ->addColumn('formatted_end_date', function ($query) {
                return $query->end_date ? Carbon::parse($query->end_date)->format('d-m-Y') : '';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hajj $model
     * @return Builder
     */
    public function query(Hajj $model) {
        $model = $model->newQuery();
        $model->select('hajjs.*')
            ->addSelect(DB::raw('CONCAT(customers.given_name, " ", customers.sur_name) AS full_name'))
            ->addSelect(DB::raw('SUM(hajj_payments.amount) as paid_amount'))
            ->addSelect(DB::raw('CAST(packages.total_price - SUM(hajj_payments.amount) AS DECIMAL(10,2)) AS due_amount'))
            ->join('customers', 'hajjs.customer_id', '=', 'customers.id', 'left')
            ->join('hajj_payments', 'hajjs.id', '=', 'hajj_payments.hajj_id', 'left')
            ->join('packages', 'hajjs.package_id', '=', 'packages.id', 'left')
            ->groupBy('hajjs.id')
            ->groupBy('hajj_payments.hajj_id')
            ->where('hajjs.type', 1);

        // Making Query
        if (isset($this->data['full_name'])) {
            $model->where(DB::raw("CONCAT(IFNULL(given_name, ''), ' ', IFNULL(sur_name, ''))"), 'like', '%' . $this->data['full_name'] . '%');
        }
        if (isset($this->data['group_id'])) {
            $model->where('customers.group_id', '=', $this->data['group_id']);
        }
        if (isset($this->data['serial_no'])) {
            $model->where('hajjs.serial_no', '=', $this->data['serial_no']);
        }
        if (isset($this->data['start_date'])) {
            $model->where('start_date', '=', Carbon::parse($this->data['start_date'])->format('Y-m-d'));
        }
        if (isset($this->data['end_date'])) {
            $model->where('end_date', '=', Carbon::parse($this->data['end_date'])->format('Y-m-d'));
        }
        if (isset($this->data['year'])) {
            $model->where('year', '=', $this->data['year']);
        }
        // End Of Making Query
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html() {
        $search = "Search: "; // We can also use variables; This is for instruction purpose only
        $page_length = 10; // We can make it dynamic dependent on User
        $row_text = " Rows";
        $need_input_columns = "[0,1]"; // We have to make the array as string to pass it because of array is is needed as string
        $builder = $this->builder();

        $filterData = [];
        if (isset($this->data['full_name'])) {
            $filterData['full_name'] = $this->data['full_name'];
        }
        if (isset($this->data['group_id'])) {
            $filterData['group_id'] = $this->data['group_id'];
        }
        if (isset($this->data['serial_no'])) {
            $filterData['serial_no'] = $this->data['serial_no'];
        }
        if (isset($this->data['start_date'])) {
            $filterData['start_date'] = $this->data['start_date'];
        }
        if (isset($this->data['end_date'])) {
            $filterData['end_date'] = $this->data['end_date'];
        }
        if (isset($this->data['year'])) {
            $filterData['year'] = $this->data['year'];
        }
        $builder->postAjax([
            'url' => route('haji-report.index'),
            'data' => $filterData,
        ]);
        $searchData = json_encode($filterData);
        return $builder
            ->setTableId('hajj-report-table')
            ->columns($this->getColumns())
            ->dom("Bfltr<'row'<'col-sm-12'tr>> <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>")
            ->orderBy(0, "ASC")
            ->parameters(array(
                'processing' => 'Please wait...',
                'searchDelay' => 500,
                'language' => array(
                    'lengthMenu' => '_MENU_ records',
                    'search' => $search,
                    'info' => 'Showing _START_ to _END_ of _TOTAL_ records',
                ),
                'lengthMenu' => array(
                    array(5, 10, 25, 50, 100, -1),
                    array('5' . $row_text, '10' . $row_text, '25' . $row_text, '50' . $row_text, '100' . $row_text, 'Show all')
                ),
                'pagingType' => "full_numbers",
                'pageLength' => $page_length,
                'createdRow' => "function (row, data, dataIndex ) {
                    $(row).attr('id', 'tr-' + data.id);
                }",
                'searchPlaceholder' => "Search...",
                'initComplete' => "function (settings, json) {
                    var searchData = $searchData;
                    for (const property in searchData) {
                        $('[name=\"'+property+'\"]').val(searchData[property]);
                    }
                    if(Object.keys(searchData).length > 0) {
                        $('#customer_report_filter').removeClass('kt-portlet--collapsed');
                    } else {
                        $('#customer_report_filter').addClass('kt-portlet--collapsed');
                    }
                    /*this.api().columns($need_input_columns).every(function (colIdx) {
                        var column = this;
                        var title = $('tfoot').find('th').eq(colIdx).text();
                        console.log($(column.footer()).empty());
                        var input = document.createElement('input');
                        // input.setAttribute('type', 'text');
                        input.placeholder = title;
                        $(input).appendTo($(column.footer()).empty())
                        .on('change keyup clear', function () {
                             column.search($(this).val(), false, false,true).draw();
                        });
                    });*/
                }",
                'preDrawCallback' => "function(){
                    $('#hajj-report-table_processing').remove();
                }",
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns() {
        return [
            Column::make('customer_full_name')->title(makeLabel('customer'))->footer(makeLabel('customer')),
            Column::make('serial_no')->footer(makeLabel('serial_no')),
            Column::make('year')->footer(makeLabel('year')),
            Column::make('formatted_start_date', 'start_date')->title(makeLabel('start_date'))->footer(makeLabel('start_date')),
            Column::make('formatted_end_date', 'end_date')->title(makeLabel('end_date'))->footer(makeLabel('end_date')),
            Column::make('departure_status_title')->footer(makeLabel('departure_status_title')),
            Column::make('paid_amount')->footer(makeLabel('paid_amount')),
            Column::make('due_amount')->footer(makeLabel('due_amount')),
            Column::make('payment_status_title')->footer(makeLabel('payment_status_title')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() {
        return 'Hajj_report_' . date('YmdHis');
    }

    public function setData($dataArray) {
        $this->data = $dataArray;
        return $this;
    }
}
