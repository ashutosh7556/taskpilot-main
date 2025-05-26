<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_reg extends Model
{
    use HasFactory;

   
    protected $table = 'admin_reg'; // matches your table name
    protected $fillable = ['name', 'email', 'password'];
}
