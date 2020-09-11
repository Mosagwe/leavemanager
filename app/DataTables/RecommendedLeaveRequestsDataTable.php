<?php

namespace App\DataTables;

use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RecommendedLeaveRequestsDataTable extends DataTable
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
                return view('app.leave.applications.status', ['leaveRequest' => $leaveRequest]);
            })->editColumn('start_at', function ($leaveRequest) {
                return $leaveRequest->start_at->format(config('custom.date_format'));
            })->editColumn('end_at', function ($leaveRequest) {
                return $leaveRequest->end_at->format(config('custom.date_format'));
            })->addColumn('action', function ($leaveRequest) {
                return view('app.leave.requests.actions.recommended', ['leaveRequest' => $leaveRequest]);
            })->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LeaveRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LeaveRequest $model)
    {
        return $model->newQuery()->select('leave_requests.*')->with('applicant:id,name', 'leaveType:id,name')
            ->where('status', LeaveRequest::PENDING_APPROVAL);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('approvedLeaveRequestsTable')
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
            Column::make('id'),
            Column::make('applicant.name')->title('Name'),
            Column::make('leave_type.name')->title('Leave Type')->name('leaveType.name'),
            Column::make('number_of_days'),
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
        return 'ProcessedLeaveRequests_' . date('YmdHis');
    }
}
