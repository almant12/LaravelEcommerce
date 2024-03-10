<?php

namespace App\DataTables\Admin;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $editBtn = "<a href='".route('admin.product.edit',$query->id)."' class='btn btn-primary mr-2'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.product.destroy',$query->id)."' class='btn btn-danger delete-item mr-2'><i class='fas fa-trash-alt'></i></a>";
                $moreBtn = '<div class="btn-group dropleft">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                      </button>
                      <div class="dropdown-menu dropleft">
                        <a class="dropdown-item" href='.route('admin.product-image-gallery.index',['product'=>$query->id]).'>Image Gallery</a>
                        <a class="dropdown-item" href='.route('admin.product-variant.index',['product'=>$query->id]).'>Variants</a>
                      </div>
                    </div>';
                $horizontalButtons = "<div class='btn-group' role='group' aria-label='Edit and Delete buttons'>
                     $editBtn
                     $deleteBtn
                     $moreBtn
                     </div>";
                return $horizontalButtons;
            })
            ->addColumn('image',function ($query){
                $url = asset($query->thumb_image);
                $img = "<div class='imageContainer' data-url='$url'>
                         <img width='70px' src='".asset($query->thumb_image)."'>
                </div>";
                return $img;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<label class="custom-switch mt-2">
              <input type="checkbox" checked name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description"></span>
                  </label>';
                } else {
                    $button = '<label class="custom-switch mt-2">
              <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description"></span>
                  </label>';
                }
                return $button;
            })
            ->addColumn('type',function ($query){
                switch ($query->product_type){
                    case 'new_arrival';
                    return '<i class="badge badge-success">New Arrival</i>';
                    break;
                    case 'featured_product';
                        return '<i class="badge badge-warning">Featured</i>';
                        break;
                    case 'top_product';
                        return '<i class="badge badge-info">Top Product</i>';
                        break;
                    case 'best_product';
                        return '<i class="badge badge-danger">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge badge-dark">None</i>';
                }
            })
            ->rawColumns(['image','type','status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id',Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('type'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
