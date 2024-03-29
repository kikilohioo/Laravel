<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('carts.index')->with([
            'cart' => $this->cartService->getFromCookie()
        ]);
    }
}
