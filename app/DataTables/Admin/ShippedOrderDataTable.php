<?php

namespace App\DataTables\Admin;

use App\Models\Order;
use App\Models\ShippedOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippedOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query){
                $showBtn = "<a href='".route('admin.order.show', $query->id)."' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                $deleteBtn = "<a href='".route('admin.order.destroy', $query->id)."' class='btn btn-danger ml-2 mr-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $horizontalButtons = "<div class='btn-group' role='group' aria-label='Edit and Delete buttons'>
                     $showBtn
                     $deleteBtn
                     </div>";
                return $horizontalButtons;
            })
            ->addColumn('order_status', function($query){
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge bg-warning'>pending</span>";
                        break;
                    case 'processed':
                        return "<span class='badge bg-info'>processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info'>dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info'>shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary'>out for delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-success'>delivered</span>";
                        break;
                    case 'canceled':
                        return "<span class='badge bg-danger'>canceled</span>";
                        break;
                    default:
                        # code...
                        break;
                }

            })
            ->addColumn('customer',function ($query){
                return $query->user->name;
            })
            ->addColumn('order_status',function ($query){
                return "<span class='badge bg-warning'>$query->order_status</span>";
            })
            ->addColumn('payment_status', function($query){
                if($query->payment_status === 1){
                    return "<span class='badge bg-success'>complete</span>";
                }else {
                    return "<span class='badge bg-warning'>pending</span>";
                }
            })
            ->addColumn('amount',function ($query){
                return $query->amount.$query->currency_name;
            })
            ->addColumn('date',function ($query){
                return date('d-M-Y h:i A',strtotime($query->created_at));
            })
            ->rawColumns(['action','customer','amount','order_status','payment_status'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('order_status','shipped')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shippedorder-table')
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
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('date'),
            Column::make('product_qty'),
            Column::make('amount'),
            Column::make('order_status'),
            Column::make('payment_status'),

            Column::make('payment_method'),


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
        return 'ShippedOrder_' . date('YmdHis');
    }
}
