<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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
                $editBtn = "<a href='".route('vendor.product.edit',$query->id)."' class='btn btn-primary edit-button'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('vendor.product.destroy',$query->id)."' class='btn btn-danger delete-item'><i class='fas fa-trash-alt'></i></a>";
                $moreBtn = '<div class="btn-group dropstart">
                 <button type="button" class="btn btn-secondary dropdown-toggle more-button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                 </button>
                  <ul class="dropdown-menu">
            <li> <a class="dropdown-item" href='.route('vendor.product-image-gallery.index',['product'=>$query->id]).'>Image Gallery</a></li>
            <li> <a class="dropdown-item" href='.route('vendor.product-variant.index',['product'=>$query->id]).'>Variants</a></li>
                     </ul>
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
            ->addColumn('is_approved',function ($query){
                if ($query->is_approved === 1){
                    return "<i class='badge bg-success'>Approved</i>";
                }else{
                    return "<i class='badge bg-warning'>Pending</i>";
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<div class="form-check form-switch">
                          <input checked class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'">
                          </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                          <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'">
                          </div>';
                }
                return $button;
            })
            ->addColumn('type',function ($query){
                switch ($query->product_type){
                    case 'new_arrival';
                        return '<i class="badge bg-success">New Arrival</i>';
                        break;
                    case 'featured_product';
                        return '<i class="badge bg-warning">Featured</i>';
                        break;
                    case 'top_product';
                        return '<i class="badge bg-info">Top Product</i>';
                        break;
                    case 'best_product';
                        return '<i class="badge bg-danger">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge bg-dark">None</i>';
                }
            })
            ->rawColumns(['image','type','status','action','is_approved'])
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
                    ->setTableId('vendorproduct-table')
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
            Column::make('is_approved'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
