<?php

namespace App\Actions;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Imag
{
    public function url($path = null, $album_id = null, $resize = true)
    {

        if ($path != null) {
            $filename = time().'.jpg';
            if($resize == true){
                $photo = Image::make($path)
                    ->encode('jpg',80);
                Storage::disk('local')->put("public/albums/". $album_id.'/'.$filename, $photo);
                $photo2 = Image::make($path)
                    ->resize(300, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',80);
                Storage::disk('local')->put("public/albums/". $album_id.'/s_'.$filename, $photo2);
            }else{
                $photo = Image::make($path)->encode('jpg',80);
                Storage::disk('local')->put("public/albums/". $album_id.'/'.$filename, $photo);
                Storage::disk('local')->put("public/albums/". $album_id.'/s_'.$filename, $photo);
            }
            return $filename;
        } else {
            return false;
        }
    }
}
