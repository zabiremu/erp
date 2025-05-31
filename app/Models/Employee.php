<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'emp_code',
        'department',
        'designation',
        'join_date',
        'salary',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
