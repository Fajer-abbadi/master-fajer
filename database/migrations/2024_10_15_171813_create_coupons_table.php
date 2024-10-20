<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount', 8, 2); // قيمة الخصم
            $table->decimal('max_discount_amount', 8, 2); // أقصى قيمة للخصم
            $table->boolean('is_active')->default(true); // حالة النشاط (فعّال أم لا)
            $table->date('expiry_date'); // تاريخ انتهاء الصلاحية
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
        Schema::dropIfExists('coupons');
    }
}

