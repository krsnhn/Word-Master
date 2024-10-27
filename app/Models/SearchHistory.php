<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = ['word', 'user_id'];

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
