<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'program_name',
        'program_desc',
        'added_by',
        'users_involve',
        'created_at'

    ];
}
