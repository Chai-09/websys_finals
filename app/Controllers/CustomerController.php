<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WorkerModel;

class CustomerController extends BaseController
{
    

    public function userDashboard() // If user_role = User, it will show the following - eiryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Redirects the User if they're not Logged In
        }

        // Uses the WorkerModel to Retrieve Workers
        $workerModel = new WorkerModel();
        $data['workers'] = $workerModel->getWorkers(); // Retrieves the Workers from the Database

        return view('customers/user', $data); // Passes the Workers' Data to the View
    }

    public function calendar() // Shows the Calendar and Time - eiryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Ensure user is logged in
        }

        // Retrieves the Worker Name from POST
        $workerName = $this->request->getPost('workerName');
        // Passes Worker Name to calendar.php
        $data = [
            'workerName' => $workerName
        ];

        return view('customers/calendar', $data);
    }

    public function receipts() // Shows the Receipt from the User and Calendar Files - eiryk
    {
        $data = [
            'selectedDate' => $this->request->getPost('selectedDate'),
            'selectedTime' => $this->request->getPost('selectedTime'),
            'workerName' => $this->request->getVar('workerName'), // Captures the Worker Name
        ];
        return view('customers/receipts', $data);
    }


}
