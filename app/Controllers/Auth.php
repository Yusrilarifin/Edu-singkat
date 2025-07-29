<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->userModel  = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    // Menampilkan form login
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/materi');
        }
        return view('auth/login');
    }

    // Proses login
    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validation->getErrors());
        }

        $user = $this->userModel
                     ->where('email', $this->request->getPost('email'))
                     ->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            // Set session
            session()->set([
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'userEmail'  => $user['email'],
                'userRole'   => $user['role']
            ]);
            return redirect()->to('/materi')->with('success', 'Login berhasil');
        }

        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Email atau password salah');
    }

    // Menampilkan form register
    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/materi');
        }
        return view('auth/register');
    }

    // Proses register
    public function registerPost()
    {
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'pass_confirm' => 'matches[password]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validation->getErrors());
        }

        $this->userModel->insert([
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user',  // default role
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout');
    }
}
