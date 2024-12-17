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
            $table->string('orderid')->unique();
            $table->unsignedBigInteger('userid');
            $table->string('username');
            $table->text('description');
            $table->decimal('price', 8, 2); // Assuming a decimal field for price, adjust precision and scale as needed
            $table->string('order_status')->default('pending'); // Default value for order_status is 'pending'
            $table->timestamps();
        
            // Foreign key constraint for userid
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
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
