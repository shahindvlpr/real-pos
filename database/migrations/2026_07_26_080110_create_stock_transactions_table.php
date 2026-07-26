<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // stock_in, stock_out, transfer, adjustment
            $table->integer('quantity');
            $table->integer('before_quantity')->default(0);
            $table->integer('after_quantity')->default(0);
            $table->string('reference_type')->nullable(); // Purchase, Sale, Manual
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_transactions');
    }
};