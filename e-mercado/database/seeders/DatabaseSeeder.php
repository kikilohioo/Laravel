<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users = User::factory()->count(20)->create();
        $products = Product::factory()->count(50)->create();

        $orders = Order::factory()
        ->count(10)
        ->make()
        ->each(function($order) use ($users){
            $order->user_id = $users->random()->id;
            $order->save();

            $payment = Payment::factory()->make();
            $payment->order_id = $order->id;
            $payment->save();
        });
    }
}
