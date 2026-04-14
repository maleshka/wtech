<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('brand', 50)->nullable();
            $table->string('size', 10)->nullable();
            $table->string('color', 30)->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_on_sale')->default(false);
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
