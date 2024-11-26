<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'pid', 'name', 'price', 'quantity', 'image'];

    // Define any relationships if needed (e.g., a relationship to the User model).
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


