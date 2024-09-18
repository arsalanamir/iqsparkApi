<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttempts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'total_questions',
        'attempted_questions',
        'correct_attempts',
        'is_paid',
        'percentage',
    ];
}
