<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->text('description')->nullable();
            
            // Pricing
            $table->decimal('cost_price', 12, 2)->default(0);
            $table->decimal('selling_price', 12, 2)->default(0);
            $table->decimal('wholesale_price', 12, 2)->nullable();
            
            // Stock
            $table->integer('stock_quantity')->default(0);
            $table->integer('min_stock_quantity')->default(0);
            $table->integer('max_stock_quantity')->nullable();
            
            // Relationships
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            
            // Tax
            $table->decimal('tax_percentage', 5, 2)->default(0)->comment('VAT/Tax percentage');
            $table->boolean('is_tax_included')->default(false);
            
            // Options
            $table->boolean('has_variants')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Media
            $table->string('image')->nullable();
            
            // Barcode
            $table->string('barcode_symbology')->default('CODE128');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};