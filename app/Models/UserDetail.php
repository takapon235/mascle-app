<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    protected $fillable = [
        'user_id', 'date', 'total_time', 'training_memo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
