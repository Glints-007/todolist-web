<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'todoId',
        'name',
        'content',
        'image',
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class, 'todoId');
    }
}
