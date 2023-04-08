<?php

namespace App\DataTables;

use App\Models\EndUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EndUsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'partials.actions')
            ->addColumn('action', function ($endUser) {
                return view('partials.actions', compact('endUser'));
            })
            ->addColumn('name', function (EndUser $endUser) {
                return $endUser->type->name??"";
            })
            ->addColumn('name', function (EndUser $endUser) {
                return $endUser->type->email??"";
            })
            ->addColumn('created_at', function (EndUser $user) {
                return date('Y-m-d', strtotime($user->created_at));
            })
    
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EndUser $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('endusers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                       
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
           
            Column::make('id'),
            Column::computed('name','name'),
            Column::computed('name','name'),
            
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'EndUsers_' . date('YmdHis');
    }
}
