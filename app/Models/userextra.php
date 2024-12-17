<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userextra extends Model
{
    use HasFactory;
    protected $fillable = [
        'userprofile',
        'mobile',
        'address',
        'pincode',
        'occupation',
        'user_id',
        // '_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
