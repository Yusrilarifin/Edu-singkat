<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'user_role' => $user['role'],
                'logged_in' => true,
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Login gagal. Periksa email atau password.');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $model = new UserModel();

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'role' => 'user', // default
        ];

        $model->save($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
