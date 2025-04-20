<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $connection = 'sqlite';
    
    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }
}