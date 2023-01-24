<?php

namespace App\DataTables\Reports;

use App\CustomerPassport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PassportsDataTable extends DataTable {
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
            ->addColumn('passport_type_title', function ($query) {
                if ($query->passport_type == 1) {
                    return "General";
                } elseif ($query->passport_type == 2) {
                    return "Government";
                } else {
                    return "Others";
                }
            })
            ->addColumn('formatted_date_of_birth', function ($query) {
                return $query->date_of_birth ? Carbon::parse($query->date_of_birth)->format('d-m-Y') : '';
            })
            ->addColumn('formatted_issue_date', function ($query) {
                return $query->issue_date ? Carbon::parse($query->issue_date)->format('d-m-Y') : '';
            })
            ->addColumn('formatted_expiry_date', function ($query) {
                return $query->expiry_date ? Carbon::parse($query->expiry_date)->format('d-m-Y') : '';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param CustomerPassport $model
     * @return Builder
     */
    public function query(CustomerPassport $model) {
        $model = $model->newQuery();

        // Making Query
        if (isset($this->data['full_name'])) {
            $model->where('full_name', 'like', '%' . $this->data['full_name'] .'%');
        }
        if (isset($this->data['passport_no'])) {
            $model->where('passport_no', '=', $this->data['passport_no']);
        }
        if (isset($this->data['date_of_birth'])) {
            $model->where('date_of_birth', '=', Carbon::parse($this->data['date_of_birth'])->format('Y-m-d'));
        }
        if (isset($this->data['issue_date'])) {
            $model->where('issue_date', '=', Carbon::parse($this->data['issue_date'])->format('Y-m-d'));
        }
        if (isset($this->data['expiry_date'])) {
            $model->where('expiry_date', '=', Carbon::parse($this->data['expiry_date'])->format('Y-m-d'));
        }
        if (isset($this->data['issue_location'])) {
            $model->where('issue_location', 'like', '%' . $this->data['issue_location'] . '%');
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
        if (isset($this->data['passport_no'])) {
            $filterData['passport_no'] = $this->data['passport_no'];
        }
        if (isset($this->data['date_of_birth'])) {
            $filterData['date_of_birth'] = $this->data['date_of_birth'];
        }
        if (isset($this->data['issue_date'])) {
            $filterData['issue_date'] = $this->data['issue_date'];
        }
        if (isset($this->data['expiry_date'])) {
            $filterData['expiry_date'] = $this->data['expiry_date'];
        }
        if (isset($this->data['issue_location'])) {
            $filterData['issue_location'] = $this->data['issue_location'];
        }
        $builder->postAjax([
            'url' => route('passport-report.index'),
            'data' => $filterData,
        ]);
        $searchData = json_encode($filterData);
        return $builder
            ->setTableId('passport-report-table')
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
                }",
                'preDrawCallback' => "function(){
                    $('#passport-report-table_processing').remove();
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
            Column::make('passport_no')->footer(makeLabel('passport_no')),
            Column::make('formatted_date_of_birth', 'date_of_birth')->title(makeLabel('date_of_birth'))->footer(makeLabel('date_of_birth')),
            Column::make('passport_type_title', 'passport_type')->footer(makeLabel('passport_type')),
            Column::make('formatted_issue_date', 'issue_date')->title(makeLabel('issue_date'))->footer(makeLabel('issue_date')),
            Column::make('formatted_expiry_date', 'expiry_date')->title(makeLabel('expiry_date'))->footer(makeLabel('expiry_date')),
            Column::make('issue_location')->footer(makeLabel('issue_location')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() {
        return 'Passport_report_' . date('YmdHis');
    }

    public function setData($dataArray) {
        $this->data = $dataArray;
        return $this;
    }
}
