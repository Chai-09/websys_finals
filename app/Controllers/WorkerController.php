<?php

namespace App\Controllers;
use App\Models\UserModel;

class WorkerController extends BaseController
{
    public function workerDashboard() // If user_role = Worker, it will show the following - eiryk
    {
        if (session()->get('user_role') !== 'worker') {
            return redirect()->to('/');
        }
        return view('workers/workers');
    }
}


