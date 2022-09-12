<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @var Request
     */
    private $req;

    public function __construct(Request $req)
    {
        $this->req = $req;
    }

    public function index()
    {
        return view('products.index')->with([
            'products' => Product::available()->get()
        ]);
    }

    public function store()
    {
        $validator = Validator::make($this->req->all(), [
            'title' => 'required',
            'description' => 'required|min:20',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        }

        return response(Product::create($this->req->all()));
    }

    public function show(Product $product)
    {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function update(Product $product)
    {
        $product->update($this->req->all());
        $productUpdated = $product->fresh();
        return response($productUpdated);
    }

    public function destroy(Product $product)
    {
        return response($product->update(['status' => 'unavailable']));
    }
}
