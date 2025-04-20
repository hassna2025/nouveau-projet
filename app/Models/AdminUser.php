<?php
// app/Models/AdminUser.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $connection = 'sqlite_admin';
    protected $table = 'admin_users';
}