<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WorkerModel;
use App\Models\BookingModel; //Adding so that it can save in database

date_default_timezone_set('Asia/Manila');
class CustomerController extends BaseController
{
    

    public function userDashboard() // If user_role = User, it will show the following 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Redirects the User if they're not Logged In
        }

        // Uses the WorkerModel to Retrieve Workers
        $workerModel = new WorkerModel();
        $data['workers'] = $workerModel->getWorkers(); // Retrieves the Workers from the Database

        //Similar to the workerDashboard() function, retrieves the data from database base on customer email
        $bookingModel = new BookingModel();
        $data['bookings'] = $bookingModel->getCustomerBookings(session()->get('id'));

        return view('customers/user', $data); // Passes the Workers' Data to the View
    }

    public function calendar() // Shows the Calendar and Time 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Ensure user is logged in
        }

        // Retrieves the Worker Name from POST
        $workerId = $this->request->getPost('workerId');

        $workerModel = new WorkerModel();
        $worker = $workerModel->find($workerId);

        // Passes Worker Name to calendar.php
        $data = [
            'workerId' => $workerId,
            'workerName' => $worker['name'] ?? ''
        ];

        

        return view('customers/calendar', $data);
    }

    public function receipts() // Shows the Receipt from the User and Calendar Files - eiryk
    {
        $data = $this->request->getPost();

        $data = [
            'selectedDate' => $this->request->getPost('selectedDate'),
            'selectedTime' => $this->request->getPost('selectedTime'),
            'worker_id' => $this->request->getPost('workerId'), // Captures the Worker Name
            'workerName' => $this->request->getPost('workerName'),
        ];

        //Saving the receipt/booking to the database to display sa worker dashboard
        $bookingModel = new BookingModel();
        $bookingModel->save([

            'customer_id' => session()->get('id'),
            'worker_id' => $data['worker_id'],
            'date_selected' => $data['selectedDate'],
            'time_selected' => $data['selectedTime'],
            'time_of_booking' => date('Y-m-d H:i:s'),

        ]
    );
        return view('customers/receipts', $data);
    }

    public function update() 
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); // Ensure user is logged in
        }
        return view ('customers/update');
    }

    public function updateProfile() // Updates user information
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/'); 
        }
    
        $userModel = new UserModel();
        $userId = session()->get('id');
        
        // Get form data
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $data = [
            'name' => $name,
            'email' => $email,
        ];
    
        // Update password if provided
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
    
        // Handle file upload for image
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid()) {
            $newImageName = $imageFile->getRandomName();
            $imageFile->move('assets/customer_image/', $newImageName);
            $data['image'] = $newImageName;
    
            // Delete old image if it's not the default image
            $oldImage = session()->get('image');
            if ($oldImage && $oldImage !== 'default.jpg') {
                $oldImagePath = 'assets/customer_image/' . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file
                }
            }
    
            // Update session image if changed
            session()->set('image', $newImageName);
        }
    
        // Update user data in database
        $userModel->update($userId, $data);
    
        // Update session data
        session()->set('name', $name);
        session()->set('email', $email);
    
        return redirect()->to('/user')->with('success', 'Profile updated successfully!');
    }
    

}
