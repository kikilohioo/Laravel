<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignIdFor(Product::class);
            $table->foreign('product_id')->references('id')->on('products');
            //crea un productable_type y un productable_id
            $table->morphs('productable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productables');
    }
};
