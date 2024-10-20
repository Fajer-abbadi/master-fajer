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
        $table->string('color')->nullable(); // إضافة عمود color للسماح بالألوان المتعددة
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('color'); // حذف العمود إذا أردت التراجع عن التغييرات
    });
}

    };
