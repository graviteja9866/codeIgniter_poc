<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AuthController extends BaseController
{
    /**
     * Display the login form.
     */
    public function loginForm()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Process login credentials.
     */
    public function login()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->findByEmail($this->request->getPost('email'));

        if ($admin && password_verify($this->request->getPost('password'), $admin['password'])) {
            // Set session data
            $sessionData = [
                'admin_id'   => $admin['id'],
                'admin_name' => $admin['name'],
                'admin_email'=> $admin['email'],
                'isLoggedIn' => true,
            ];

            session()->set($sessionData);
            session()->regenerate(); // Prevent session fixation

            return redirect()->to('/dashboard')->with('success', 'Welcome back, ' . $admin['name'] . '!');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
    }

    /**
     * Logout and clear session.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }
}
