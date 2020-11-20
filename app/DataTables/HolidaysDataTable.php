<?php

namespace App\DataTables;

use App\Models\Holiday;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HolidaysDataTable extends DataTable
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
            ->addColumn('action', function ($holiday) {
                return view('app.holidays.action', [
                    'holiday' => $holiday
                ]);
            })
            ->editColumn('is_annual', function ($holiday) {
                return view('app.holidays.status', [
                    'holiday' => $holiday
                ]);
            })->editColumn('date', function ($holiday) {
                return Carbon::createFromFormat('Y-m-d',$holiday->date)->format(config('custom.date_format'));
            })
            ->rawColumns(['action', 'is_annual']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Holiday $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Holiday $model)
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
            ->setTableId('holidaysTable')
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
            Column::make('date'),
            Column::make('is_annual'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
