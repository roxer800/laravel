<?php

namespace App\Models;

use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacansy extends Model
{
    use HasFactory;

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['available_at'];
    protected $photo = ['photo'];
    protected $fillable = ['name', 'description', 'users_id', 'available_at', 'photo'];
}
