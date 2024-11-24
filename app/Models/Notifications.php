<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'content',
        'user_id',
        'added_by',
        'created_at',
        'project_status'
    ];
}
