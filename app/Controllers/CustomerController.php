<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WorkerModel;
use App\Models\BookingModel; //Adding so that it can save in database

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

        //Similar to the workerDashboard() function, retrieves the data from database base on customer email
        $bookingModel = new BookingModel();
        $data['bookings'] = $bookingModel->where('customer_email', session()->get('email'))->findAll();

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

        //Saving the receipt/booking to the database to display sa worker dashboard
        $bookingModel = new BookingModel();
        $bookingModel->save([

            'customer_name' => session()->get('name'),
            'customer_email' => session()->get('email'),
            'worker_name' => $data['workerName'],
            'date_selected' => $data['selectedDate'],
            'time_selected' => $data['selectedTime'],
            'time_of_booking' => date('Y-m-d H:i:s'),



        ]);


        return view('customers/receipts', $data);
    }


}
