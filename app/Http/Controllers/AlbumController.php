<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Imag;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function getIndex()
    {
        $albums = Album::orderBy('id', 'DESC')->limit(100)->get();
        return view('welcome', compact('albums'));
    }

    public function getOne(Album $album)
    {
        return view('album', compact('album'));
    }

    public function postIndex(Request $request)
    {
        $album = Album::firstOrCreate([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => optional(Auth::user())->id
        ]);
        return redirect()->back();
    }

    public function postProduct(Request $request, Album $album)
    {
        if ($request->hasFile('picture1')) {
            $picture = (new Imag)->url($request->file('picture1'), $album->id, true);
            $product = new Product;
            $product->album_id = $album->id;
            $product->user_id = Auth::user()->id;
            $product->picture = $picture;
            $product->name = $request->name ?? '';
            $product->status = '';
            $product->save();
        } else {

        }
        return redirect()->back();
    }

    public function getProduct(Product $product)
    {
        $comments = $product->comments()->orderBy('id', 'DESC')->paginate(80);
        return view('product', compact('product', 'comments'));
    }

    public function postComment(Request $request, Product $product)
    {
        if ($request->body) {
            $comment = new Comment;
            $comment->product_id = $product->id;
            $comment->user_id = Auth::user()->id;
            $comment->body = $request->body;
            $comment->save();
        }
        return redirect()->back();
    }

    public function likes(Request $request, Product $product)
    {
        abort_if(!$request->znak, '403');
        $like = Likes::where('product_id', $product->id)->where('ip', $request->ip())->first();
        if (!$like) {
            Likes::create([
                'product_id' => $product->id,
                'ip' => $request->ip(),
                'total' => 1,
                'znak' => $request->znak
            ]);
        }
        return redirect()->back();
    }

    public function like_del(Request $request, Product $product)
    {
         Likes::where('product_id', $product->id)->where('ip', $request->ip())->delete();
         return redirect()->back();
    }
    public function getDelete(Album $album){
        $album->delete();
        return redirect()->back();
    }
    public function getEdit(Album $album){
        return view('auth.album_edit', compact('album'));
    }
    public function postEdit(Request $request, Album $album){
        $album->update($request->all());
        return redirect()->back();
    }
    public function getProductDelete(Product $product){
        Storage::delete('public/albums/'.$product->album_id.'/'.$product->picture);
        Storage::delete('public/albums/'.$product->album_id.'/s_'.$product->picture);
        $product->delete();
        return redirect('album/'.$product->album_id);
    }
}
