<?php

namespace App\Controllers;
use App\Models\UserModel;

class WorkerController extends BaseController
{
    public function workerDashboard() //if user_role is worker, then ito yung ipapakita - ryk
    {
        if (session()->get('user_role') !== 'worker') {
            return redirect()->to('/');
        }
        return view('workers/workers');
    }
}


