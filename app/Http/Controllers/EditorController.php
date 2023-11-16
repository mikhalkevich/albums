<?php

namespace App\Http\Controllers;

use App\Actions\Imag;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function upload(Request $request, $article_id = null){
        $album_id = 1;
        $article = null;
        if($article_id){
            $article = Article::find($article_id);
            $album_id = optional($article->picture)->album_id;
        }
        if($request->hasFile('upload')){
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $picture = (new Imag)->url($request->file('upload'), $album_id, true);
            $product = new Product;
            $product->album_id = $album_id;
            $product->user_id = optional(Auth::user())->id;
            $product->picture = $picture;
            $product->name = $article->name;
            $product->status = '';
            $product->save();
        }
        echo json_encode([
            'default' => asset('storage/albums/'.$album_id.'/'.$picture),
            '500' => asset('storage/albums/'.$album_id.'/'.$picture)
        ]);
    }
}
