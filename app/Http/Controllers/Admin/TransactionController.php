<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TransactionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller{


    public function index(TransactionDataTable $dataTable){
        return $dataTable->render('admin.transaction.index');
    }
}
