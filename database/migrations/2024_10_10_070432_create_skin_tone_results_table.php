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
        Schema::create('skin_tone_results', function (Blueprint $table) {
            $table->id();
            $table->string('skin_tone');
            $table->text('shade_recommendations'); // لتخزين النصوص أو القيم المناسبة
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skin_tone_results');
    }
};
