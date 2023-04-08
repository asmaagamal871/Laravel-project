<?php

namespace App\DataTables;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AddressesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'addresses.action')
            ->addColumn('action', function ($address) {
                return view('addresses.actions', compact('address'));
            })
            ->addColumn('username', function (Address $address) {
                return $address->end_user->type->name??"";
            })
            ->addColumn('Address', function (Address $address) {
                return "$address->st_name, $address->building_no, $address->floor_no, $address->flat_no";
            })
            ->addColumn('main', function (Address $address) {
                return ($address->is_min) ? 'YES' : 'NO';
            })
            ->addColumn('created_at', function (Address $address) {
                return date('Y-m-d', strtotime($address->created_at));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Address $model): QueryBuilder
    {
        $user = Auth::user();

        if ($user->can('manage-own-addresses')) { //user is admin or end user
            if ($user->can('manage-addresses')) { //if admin
                return Address::query();
            } else { //if end user
                return Address::query()->where('end_user_id', $user->typeable->id);
            }
        } else {
            abort(403, 'Unauthorized action.');
        }




        // $user = Auth::user();
        // $model = Address::query();
        // if ($user->cannot('manage-orders')) { //if not admin
        //     if ($user->can('manage-own-orders')) { //user
        //         return Address::query()->where('user_id', $user->typeable->id);
        //     } elseif ($user->can('view-orders')) { //pharmacy
        //         return Address::query()->where('pharmacy_id', $user->typeable->id);
        //     } elseif ($user->can('update-order-status')) { //doctor
        //         return Address::query()->where('pharmacy_id', $user->typeable->pharmacy_id);
        //     }
        // } else { //if admin
        //     return $model->newQuery();
        // };


        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('addresses-table')
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
            Column::computed('username', 'username'),
            Column::computed('Address', 'Address'),
            Column::computed('main', 'main'),
            Column::make('created_at'),
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
        return 'Addresses_' . date('YmdHis');
    }
}
