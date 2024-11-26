<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Chỉ định tên bảng là 'admins'
    
    protected $fillable = ['name', 'password']; // Các trường có thể gán

    public function cartItems()
{
    return $this->hasMany(Cart::class, 'user_id');  // Giả sử Cart có cột 'user_id'
}
}

