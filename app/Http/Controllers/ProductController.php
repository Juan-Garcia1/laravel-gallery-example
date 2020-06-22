<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function show(Product $product)
    {
        $gallery = DB::table('products')
            ->join('galleries', 'products.id', '=', 'galleries.product_id')
            ->selectRaw('galleries.id, galleries.image as image')
            ->where('galleries.product_id', '=', $product->id)
            ->get();
        // $gallery = Product::find($product)->with('gallery')->get();
        return view('product.show', compact('product', 'gallery'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg|max:5000'
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('uploads', $fileNameToStore, 'public');
        }
        $product->image = $fileNameToStore;
        // dd($request);
        $product->save();

        $last_inserted_id = $product->id;

        $images = Collection::wrap(request()->file('gallery'));
        $images->each(function ($image) use ($last_inserted_id) {
            $gallery = new Gallery();
            $fileNameWithExt = $image->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $image->storeAs('uploads/gallery', $fileNameToStore, 'public');
            $gallery->product_id = $last_inserted_id;
            $gallery->image = $fileNameToStore;
            $gallery->save();
        });

        return redirect()->back();
    }
}
