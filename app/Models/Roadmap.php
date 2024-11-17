<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $table = 'roadmap';
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'status',
        'date_created',
        'user_id'
    ];
}
