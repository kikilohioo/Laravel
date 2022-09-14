<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\Image;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creando 20 usuarios
        $users = User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) {
                //creando imagenes para cada usuario
                $image = Image::factory()
                    ->user()
                    ->make();

                //attach imagen a usuario
                $user->image()->save($image);
            });

        //creando 10 ordenes(y sus pagos) y asignandolas aleatoriamente a usuario
        $orders = Order::factory()
            ->count(10)
            ->make()
            ->each(function ($order) use ($users) {
                $order->user_id = $users->random()->id;
                $order->save();

                $payment = Payment::factory()->make();
                $payment->order_id = $order->id;
                $payment->save();
            });

        //creando 50 productos
        $carts = Cart::factory()
            ->count(50)
            ->create();

        //creando 50 productos
        Product::factory()
            ->count(50)
            ->create()
            ->each(function ($product) use ($orders, $carts){
                //agregar productos aleatoriamente a las ordenes
                $order = $orders->random();
                $order->products()->attach([
                    $product->id => ['quantity' => mt_rand(1,10)]
                ]);

                //agregar productos aleatoriamente a los carritos
                $cart = $carts->random();
                $cart->products()->attach([
                    $product->id => ['quantity' => mt_rand(1,10)]
                ]);

                //creando imagenes para cada producto
                $images = Image::factory(mt_rand(1,4))->make();

                //attach imagen a producto
                $product->images()->saveMany($images);
            });
    }
}
