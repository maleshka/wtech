<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->decimal('total_price', 10, 2);
            $table->enum('delivery_method', ['personal', 'courier', 'post']);
            $table->enum('payment_method', ['card', 'cash', 'transfer']);
            $table->string('first_name', 50);
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->string('street', 50);
            $table->string('city', 50);
            $table->string('postal', 20);
            $table->string('region', 50);
            $table->string('country', 50);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
