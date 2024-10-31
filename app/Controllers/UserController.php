<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WorkerModel; // added for worker - ryk

class UserController extends BaseController
{
    public function store() // Save Data in Register.php
    {
        helper(['form']);
         
        $rules = [
            'name'            => 'required|min_length[5]|max_length[50]',
            'email'           => 'required|min_length[12]|max_length[100]|valid_email|is_unique[users.email]',
            'password'        => 'required|min_length[5]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $account = new UserModel();
            
            $data = [
                'name'      => $this->request->getVar('name'),
                'email'     => $this->request->getVar('email'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'user_role' => $this->request->getVar('user_role'),
            ];
            
            $account->save($data);
            
            return redirect()->to('/signin');
        } else {
            $data['validation'] = $this->validator;
            return view('register', $data);
        }
    }

    public function signin() // Load the sign-in view
    {
        helper(['form']);
        $data = [];
        return view('sign', $data);
    }

    public function login() // Login Logic
    {
        helper(['form']);
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first(); 

        if ($user && password_verify($password, $user['password'])) { 
            
            $sessionData = [
                'id'        => $user['id'],
                'name'      => $user['name'],
                'email'     => $user['email'],
                'user_role' => $user['user_role'],
                'isLoggedIn'=> true,
            ];
            
            session()->set($sessionData);

            
            switch ($user['user_role']) {
                case 'head_admin':
                    return redirect()->to('/head_admin');
                case 'worker':
                    return redirect()->to('/workers');
                case 'user':
                    return redirect()->to('/user');
                default:
                    return redirect()->to('/dashboard');
            }
        } else {
            $data['validation'] = 'Invalid email or password.';
            return view('sign', $data); 
        }
    }

    public function register() // form of register
    {
        helper(['form']);
        $data = [];
        return view('register', $data);
    }

    public function logout()
    {
        session()->destroy(); // Destroy all session data
        return redirect()->to('/signin'); // Redirect to sign in page
    }

    /*public function dashboard()
    {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signin'); // Redirect to sign-in page
        }
    
        // Load the dashboard view
        return view('dashboard');
    }*/

    //user_role's to their respective dashboards. here
    public function headAdminDashboard() //if user_role is head_admin, then ito yung ipapakita - ryk
    {
        if (session()->get('user_role') !== 'head_admin') {
            return redirect()->to('/signin');
        }
        return view('roleDashboard/head_admin');
    }

    public function workerDashboard() //if user_role is worker, then ito yung ipapakita - ryk
    {
        if (session()->get('user_role') !== 'worker') {
            return redirect()->to('/signin');
        }
        return view('roleDashboard/workers');
    }

    public function userDashboard() //if user_role is user, then ito yung ipapakita - ryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signin'); // Redirect if not logged in
        }

        // Use the WorkerModel to fetch workers
        $workerModel = new WorkerModel();
        $data['workers'] = $workerModel->getWorkers(); // Get workers from the database

        return view('roleDashboard/user', $data); // Pass workers data to the view
    }

    // hanggang here :>

    public function calendar() // shows the calendar and time - ryk
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signin'); // Ensure user is logged in
        }
        return view('roleDashboard/calendar');
    }

    public function receipts() // shows the receipt from user and calendar file - ryk
    {
        $data = [
            'selectedDate' => $this->request->getPost('selectedDate'),
            'selectedTime' => $this->request->getPost('selectedTime'),
            'workerName' => $this->request->getVar('workerName'), // Capture the worker name
        ];
        return view('roleDashboard/receipts', $data);
    }


}
