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
            ];
            
            $account->save($data);
            
            return redirect()->to('/');
        } else {
            $data['validation'] = $this->validator;
            return view('register', $data);
        }
    }

    public function index() 
    {
        return view ('/');
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
                'status' => $user['status'],
                'isLoggedIn'=> true,
            ];
            
            session()->set($sessionData);

            if ($user['status'] === 'Active') {

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
                $data['validation'] = 'Your account is Inactive. Please contact your Head Admin';
                return view('sign', $data); 
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
        return redirect()->to('/'); // Redirect to sign in page
    }

}
