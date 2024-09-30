<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dashboard_id'];

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
