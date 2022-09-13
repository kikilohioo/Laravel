<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'products' => Product::all()
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        $rules = [
            'title' => 'required',
            'description' => ['required', 'min:20'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        $this->req->validate($rules);

        if($this->req->status == 'available' && $this->req->stock == 0){
            return redirect()
            ->back()
            ->withInput($this->req->all())
            ->withErrors('If available must have stock');
        }

        Product::create($this->req->all());

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

    public function update(Product $product)
    {
        $rules = [
            'title' => 'required',
            'description' => ['required', 'min:20'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        
        $this->req->validate($rules);

        if ($this->req->status == 'available' && $this->req->stock == 0) {
            session()->flash('error', 'If available must have stock');
            return redirect()->back()->withInput($this->req->all());
        }
        
        $product->update($this->req->all());

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
