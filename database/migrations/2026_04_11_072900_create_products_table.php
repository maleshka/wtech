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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->decimal('price', 10, 2);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->text('description');
            $table->string('brand', 50);
            $table->string('size', 5);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('color', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
