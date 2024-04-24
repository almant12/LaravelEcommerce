<?php


namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait{


    public function uploadImage(Request $request,$inputName){
        $path = 'upload';
        if ($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path),$imageName);

            return $path.'/'.$imageName;
        }
    }
    public function uploadMultipleImages(Request $request,$inputName){
        $path = 'upload';
        $imagesPaths = [];
        if ($request->hasFile($inputName)){
            $images = $request->{$inputName};
            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() . '.' . $ext;
                $image->move(public_path($path), $imageName);
                $imagesPaths[] = $path.'/'.$imageName;
            }
            return $imagesPaths;
        }
    }

    public function updateImage(Request $request,$inputName,$oldPath=null){
        $path = 'upload';
        if ($request->hasFile($inputName)){
            if (File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path),$imageName);

            return $path.'/'.$imageName;
        }
    }

    public function deleteImage($path){
        if (File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
