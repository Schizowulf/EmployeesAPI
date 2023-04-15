<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "patronymic",
        "surname",
        "birthday",
        "position",
        "phone",
        "avatar_url",
    ];

    public $timestamps = false;
}
