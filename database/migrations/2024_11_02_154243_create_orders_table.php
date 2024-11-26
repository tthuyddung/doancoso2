<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('product_id');
        $table->string('name');
        $table->string('number');
        $table->string('email');
        $table->string('method');
        $table->text('address');
        $table->string('destination')->nullable(); // Địa chỉ có thể là null
        $table->integer('rental_hours')->default(1); // Số giờ thuê mặc định là 1
        $table->decimal('total_price', 8, 2)->default(0); // Tổng tiền, kiểu số thập phân
        $table->decimal('total_products', 8, 2)->default(0)->change(); 
        $table->string('payment_status')->default('pending'); // Trạng thái thanh toán mặc định là 'pending'
        $table->timestamps();
    
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
    
}



    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
