<?php

namespace App\Controllers;
use App\Models\UserModel;

class HeadAdminController extends BaseController
{
    public function index()
    {

        if (session()->get('user_role') !== 'head_admin') {
            return redirect()->to('/');
        }

        $role_filter = $this->request->getGet('role_filter') ?? 'all';
        $userModel = new UserModel();

        if ($role_filter === 'all') {
            $accounts = $userModel->findAll();
        } else {
            $accounts = $userModel->where('user_role', $role_filter)->findAll();
        }

        return view('roleDashboard/head_admin', ['accounts' => $accounts, 'role_filter' => $role_filter]);
    }

    public function add_worker()
    {
        $userModel = new UserModel();
        $userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'user_role' => 'worker',
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/head_admin');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/head_admin');
    }

    public function edit($id)
{
    $userModel = new UserModel();
    $account = $userModel->find($id);

    if (!$account) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("User with ID $id not found");
    }

    return view('roleDashboard/edit', ['account' => $account]);
}


    public function update($id)
{
    $userModel = new UserModel();
    $userModel->update($id, [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'status' => $this->request->getPost('status'),
    ]);

    return redirect()->to('/head_admin');
}

}


