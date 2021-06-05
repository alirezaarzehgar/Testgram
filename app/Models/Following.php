<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;
    protected $fillable = ['following_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
