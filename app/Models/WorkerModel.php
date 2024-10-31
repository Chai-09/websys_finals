<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkerModel extends Model
{
    // Fetch users in database - ryk
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
        return $this->where('user_role', 'worker')->findAll(); // Fetch workers based on user_role - ryk
    }
}
