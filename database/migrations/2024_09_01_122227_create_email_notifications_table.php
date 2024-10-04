<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('notification_type', ['order_status', 'promotion', 'design_update']);
            $table->text('message');
            $table->timestamp('sent_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_notifications');
    }
}
