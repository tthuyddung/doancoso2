<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateAdminPassword extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    DB::table('admins')->updateOrInsert(
        ['name' => 'dung'], // Điều kiện tìm bản ghi
        ['password' => Hash::make('123')] // Cập nhật hoặc tạo mới mật khẩu
    );
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Có thể để trống hoặc khôi phục mật khẩu cũ nếu cần
    }
}
