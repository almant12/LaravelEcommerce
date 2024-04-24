<?php

namespace App\Http\Controllers\User;

use App\DataTables\User\UserProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductImageGallery;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProductReviewController extends Controller{

    use ImageUploadTrait;

    public function index(UserProductReviewDataTable $dataTable){
        return $dataTable->render('frontend.dashboard.review.index');
    }

    public function create(Request $request){

        $request->validate([
            'review'=>['required','max:200'],
            'rating'=>['required'],
            'images.*'=>['image']
        ]);

        $checkReviewExist = ProductReview::where(['product_id'=>$request->product_id,'user_id'=>Auth::user()->id])->first();
        if ($checkReviewExist){
            toastr('You already added a review for this product!', 'error', 'error');
            return redirect()->back();
        }

        $productReview = new ProductReview();
        $productReview->review = $request->review;
        $productReview->rating = $request->rating;
        $productReview->status = 0;
        $productReview->product_id = $request->product_id;
        $productReview->user_id = Auth::user()->id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->save();

        $imagePaths = $this->uploadMultipleImages($request,'images');
        if (!empty($imagePaths)){
            foreach ($imagePaths as $path){
                $reviewGallery = new ProductReviewGallery();
                $reviewGallery->image = $path;
                $reviewGallery->product_review_id = $productReview->id;
                $reviewGallery->save();
            }
        }

        toastr('Review added successfully!', 'success', 'success');

        return redirect()->back();

    }
}
