<?php

namespace App\DataTables\Reports;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable {
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
            ->addColumn('gender', function ($query) {
                if ($query->gender == 1) {
                    return "Male";
                }
                return "Female";
            })
            ->addColumn('passport_number', function ($query) {
                if ($query->passport) {
                    return $query->passport->passport_no;
                }
                return "";
            })
            ->filterColumn('full_name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(IFNULL(given_name, ''), ' ', IFNULL(sur_name, '')) like ?", "%{$keyword}%");
            })
            ->orderColumn('full_name', 'given_name $1')
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model) {
        $model = $model->newQuery();
        $model->with(['passport' => function ($q) {
            if (isset($this->data['passport_no'])) {
                $q->where('passport_no', 'like', '%' . $this->data['passport_no'] . '%');
            }
        }]);

        if ($this->request()->get('email')) {
            $model->where('email', $this->request()->get('email'));
        }
        // Making Query
        if (isset($this->data['full_name'])) {
            $model->where(DB::raw("CONCAT(IFNULL(given_name, ''), ' ', IFNULL(sur_name, ''))"), 'like', '%' . $this->data['full_name'] . '%');
        }
        if (isset($this->data['email'])) {
            $model->where('email', 'like', $this->data['email'] . '%');
        }
        if (isset($this->data['passport_no'])) {
            $model->whereHas('passport', function ($q) {
                $q->where('passport_no', 'like', '%' . $this->data['passport_no'] . '%');
            });
        }
        if (isset($this->data['mobile'])) {
            $model->where('mobile', 'like', '%' . $this->data['mobile'] . '%');
        }
        // End Of Making Query
         return $this->applyScopes($model);
//        return $model;
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
        if (isset($this->data['email'])) {
            $filterData['email'] = $this->data['email'];
        }
        if (isset($this->data['passport_no'])) {
            $filterData['passport_no'] = $this->data['passport_no'];
        }
        if (isset($this->data['mobile'])) {
            $filterData['mobile'] = $this->data['mobile'];
        }
        $builder->postAjax([
            'url' => route('customer-report.index'),
            'data' => $filterData,
        ]);
        $searchData = json_encode($filterData);
        return $builder
            ->setTableId('customer-report-table')
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
                    var DT = this.api();
                    var searchData = $searchData;
                    for (const property in searchData) {
                        $('input[name=\"'+property+'\"]').val(searchData[property]);
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
                    afterTableInitialization(settings, json);
                    customSearchAjax(settings, json, $('#customer-report-form'));
                }",
                'preDrawCallback' => "function(){
                    $('#customer-report-table_processing').remove();
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
            Column::make('full_name')->footer(makeLabel('full_name')),
            Column::make('father_name')->footer(makeLabel('father_name')),
            Column::make('gender')->footer(makeLabel('gender')),
            Column::make('passport_number')->footer(makeLabel('passport_number')),
            Column::make('mobile')->footer(makeLabel('mobile')),
            Column::make('email')->footer('Email'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() {
        return 'Customer_report_' . date('YmdHis');
    }

    public function setData($dataArray) {
        $this->data = $dataArray;
        return $this;
    }
}
