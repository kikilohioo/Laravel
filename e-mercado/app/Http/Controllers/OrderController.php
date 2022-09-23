<?php

namespace App\Http\Controllers;


use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use MercadoPago;
use MercadoPago\Item;
use MercadoPago\Preference;

class OrderController extends Controller
{
    public $cartService;
    
    public function __construct(CartService $cartService){
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    public function create()
    {
        $cart = $this->cartService->getFromCookie();

        if(!isset($cart) || $cart->products->isEmpty()){
            return redirect()
                ->back()
                ->withErrors('Your cart is empty!');
        }

        return view('orders.create')->with([
            'cart' => $cart
        ]);
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use ($request){
            $user = $request->user();
    
            $order = $user->orders()->create([
                'status' => 'pending'
            ]);
    
            $cart = $this->cartService->getFromCookie();

            $items = array();
    
            $cartProductsWithQuantity = $cart->products->mapWithKeys(function($product) use (&$items){
                $element[$product->id] = ['quantity' => $product->pivot->quantity];
                $quantity = $product->pivot->quantity;

                $item = new Item();
                $item->title = $product->title;
                $item->quantity = $quantity;
                $item->unit_price = $product->price;

                array_push($items, $item);

                if($product->stock < $quantity){
                    throw ValidationException::withMessages([
                        'product' => "There is not enough stock for the quantity you required of {$product->title}"
                    ]);
                }

                $product->decrement('stock', $quantity);
    
                return $element;
            });

            $preference = new Preference();
            $preference->items = $items;    
            $preference->save();

            $order->products()->attach($cartProductsWithQuantity->toArray());
    
            return redirect()->route('orders.payments.create', [
                'order' => $order,
                'cart' => $preference->id
            ]);
        }, 5);
        
    }
}
