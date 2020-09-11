<?php

namespace App\DataTables;

use App\Models\LeaveType;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeaveTypesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($leaveType) {
                return view('app.leave_types.action', [
                    'leaveType' => $leaveType
                ]);
            })
            ->editColumn('can_use_partially', function ($leaveType) {
                return view('app.leave_types.status', [
                    'leaveType' => $leaveType
                ]);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \\App\Models\LeaveType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LeaveType $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('leaveTypesTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(1);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('maximum_days'),
            Column::make('carry_over_days'),
            Column::make('gender'),
            Column::make('can_use_partially')
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
