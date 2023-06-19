<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Table
    protected $table = 'user';
    // allowed fields to manage
    protected $allowedFields = ['firstname', 'middlename','lastname', 'password', 'gender', 'contact', 'email', 'address', 'date_created', 'date_updated'];
}