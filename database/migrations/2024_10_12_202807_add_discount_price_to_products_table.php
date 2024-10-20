<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('discount_price', 8, 2)->nullable(); // عمود للسعر بعد الخصم
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('discount_price');
    });
}


    /**
     * Reverse the migrations.
     */
  
};