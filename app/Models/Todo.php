<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'name',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function list()
    {
        return $this->hasMany(ListTodo::class, 'todoId');
    }
}
