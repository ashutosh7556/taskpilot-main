<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admins';

    protected $fillable = [ 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
