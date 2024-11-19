<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    if (!Schema::hasTable('admins')) {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
    
    // Chỉ thêm admin nếu bảng chưa có dữ liệu
    if (DB::table('admins')->count() == 0) {
        DB::table('admins')->insert([
            'name' => 'admin_name',
            'password' => Hash::make('admin_password'),
        ]);
    }
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
