<?php

namespace App\DataTables;

use App\Models\LeaveRequest;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeaveApplicationsDataTable extends DataTable
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
            ->editColumn('status', function ($leaveRequest) {
                return view('app.leave.applications.status',['leaveRequest' => $leaveRequest]);
            })->editColumn('start_at', function ($leaveRequest) {
                return $leaveRequest->start_at->format(config('custom.date_format'));
            })->editColumn('end_at', function ($leaveRequest) {
                return $leaveRequest->end_at->format(config('custom.date_format'));
            })
            ->addColumn('action', function ($leaveRequest) {
                return view('app.leave.applications.action',['leaveRequest' => $leaveRequest]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LeaveRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LeaveRequest $model)
    {
        return $model->newQuery()->with('leaveType')->where('user_id', \Auth::user()->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('individualLeaveRequestsTable')
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
            Column::make('leave_type.name')->title('Leave Type'),
            Column::make('number_of_days')->title('Days'),
            Column::make('start_at'),
            Column::make('end_at'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'IndividualLeaveRequests_' . date('YmdHis');
    }
}
