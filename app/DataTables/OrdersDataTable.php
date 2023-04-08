<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($order) {
            return view('order.actions', compact('order'));
        })

        ->addColumn('User', function (Order $order) {
            return $order->user->type->name??"";
        })
        ->addColumn('created_at', function (Order $order) {
            return date('Y-m-d', strtotime($order->created_at));
        })
        // ->addColumn('updated_at', function (Order $order) {
        //     return date('Y-m-d', strtotime($order->updated_at));
        // })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if (Auth::user()->hasRole('admin')) {
            return $model->newQuery();
        } elseif (Auth::user()->hasRole('end-user')) {
            return $model->newQuery()->where('user_id', Auth::user()->typeable->id);
        } elseif (Auth::user()->hasRole('pharmacy')) {
            return $model->newQuery()->where('pharmacy_id', Auth::user()->typeable->id);
        } elseif (Auth::user()->hasRole('doctor')) {
            return $model->newQuery()->where('doctor_id', Auth::user()->typeable->id);
        }
    }

    /**
             * Optional method if you want to use the html builder.
             */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
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
            // Column::make('delivery_address_id'),
            // Column::computed('pharmacy','pharmacy'),
            Column::computed('User', 'User'),
            Column::make('status'),
            Column::computed('created_at', 'created_at'),
            Column::computed('updated_at', 'updated_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(220)
                  ->addClass('text-center'),
        ];
    }
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
