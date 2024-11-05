<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkerModel extends Model
{
    // Fetches the Users' Data in the Database - eiryk
    protected $table = 'users'; 
    protected $primaryKey = 'id';   
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'user_role',
        'status'
    ];

    public function getWorkers() 
    {
        return $this->where('user_role', 'worker')->findAll(); // Fetches the Workers Based on user_role - eiryk
    }
}
