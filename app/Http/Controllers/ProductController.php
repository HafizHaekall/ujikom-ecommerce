<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index()
    {
        $products = [];
        if (request('query') && request('query') !== null) {
            $query = request('query');
            $products = Product::where('name', 'like', '%'.$query.'%')->orWhere('price', 'like', '%'.$query.'%')->orWhere('description', 'like', '%'.$query.'%')->get();
        } else {
            $products = Product::all();
        }

        if (Auth::check() && Auth::user()->is_admin) {
            return view('home', compact('products'));
        }

        return view('home', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);
        return Redirect::route('home');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        $file = $request->file('image');

        if ($request->hasFile('image')) {
            $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/' . $path, file_get_contents($file));

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $path
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);
        }

        return Redirect::route('product.show', $product);
    }

    public function delete_product(Product $product)
    {
        $product->delete();
        return Redirect::route('home');
    }
}
