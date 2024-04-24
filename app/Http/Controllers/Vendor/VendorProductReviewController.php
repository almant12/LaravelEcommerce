<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\Vendor\VendorProductReviewDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{


    public function index(VendorProductReviewDataTable $dataTable){
        return $dataTable->render('vendor.review.index');
    }
}
