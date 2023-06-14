<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        // Validate input
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if user exists
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->to(current_url())->withInput()->with('error', 'Invalid email or password');
        }

        // Store user data in session
        $userData = [
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'user_profile_picture' => $user['profile_picture']
        ];

        session()->set($userData);

        return redirect()->to('/dashboard')->with('success', 'Logged in successfully');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Logged out successfully');
    }
    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
    }

    // ...
    // ...
    public function forgotPassword()
    {
        // Validate input
        $validationRules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if user exists
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'User with the provided email does not exist');
        }

        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Update user record in the database with the token
        $userModel->update($user['id'], ['reset_token' => $token]);

        // Send an email to the user with the password reset link
        $email = service('email');

        $email->setTo($user['email']);
        $email->setSubject('Password Reset');
        $email->setMessage('Click the link below to reset your password: ' . site_url('reset-password?token=' . $token));

        if ($email->send()) {
            return redirect()->back()->with('success', 'Password reset link has been sent to your email');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to send password reset email');
        }
    }
    // ...


    // ...
    // ...
    public function resetPassword()
    {
        // Validate input
        $validationRules = [
            'token' => 'required',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // Check if token is valid and not expired
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
            ->where('reset_token_expires >', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Invalid or expired token');
        }

        // Update user's password in the database
        $userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expires' => null
        ]);

        // Clear the token from the user's record
        // ...

        return redirect()->to('/login')->with('success', 'Password reset successfully');
    }
    // ...



}
