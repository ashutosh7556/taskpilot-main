<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    // ✅ Rename to 'tasks' table unless you have a strong reason not to
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'assigned_by',
        'status',
    ];

    // ✅ User who took the task
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Admin who assigned the task
    public function assignedByAdmin()
    {
        return $this->belongsTo(\App\Models\Admins::class, 'admins_id');
    }

}
