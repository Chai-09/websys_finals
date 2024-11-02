<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WorkerModel;

class CustomerController extends BaseController
{
    

    public function userDashboard() //if user_role is user, then ito yung ipapakita - ryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Redirect if not logged in
        }

        // Use the WorkerModel to fetch workers
        $workerModel = new WorkerModel();
        $data['workers'] = $workerModel->getWorkers(); // Get workers from the database

        return view('customers/user', $data); // Pass workers data to the view
    }

    public function calendar() // shows the calendar and time - ryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Ensure user is logged in
        }

        return view('customers/calendar');
    }

    public function receipts() // shows the receipt from user and calendar file - ryk
    {
        $data = [
            'selectedDate' => $this->request->getPost('selectedDate'),
            'selectedTime' => $this->request->getPost('selectedTime'),
            'workerName' => $this->request->getVar('workerName'), // Capture the worker name
        ];
        return view('customers/receipts', $data);
    }


}
