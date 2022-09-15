<?php

namespace App\Http\Controllers\Panel;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @var Request
     */
    private $req;

    public function __construct(Request $req)
    {
        $this->req = $req;
        $this->middleware('auth')->except(['show']);
    }

    public function index()
    {
        return view('products.index')->with([
            'products' => Product::all()
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
        ->route('products.index')
        ->withSuccess('Product created successfully');
    }

    public function show(Product $product)
    {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
        ->route('products.index')
        ->withSuccess('Product updated successfully');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
        ->route('products.index')
        ->withSuccess('Product deleted successfully');
    }
}
