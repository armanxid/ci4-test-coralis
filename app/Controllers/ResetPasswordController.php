<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;

class ResetPasswordController extends BaseController
{
    public function index()
    {
        // $request = service('request');
        $tokenValue = $this->request->getGet('token');
        return view('reset_password', ['token' => $tokenValue]);
    }

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
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('login')->with('error', 'Invalid or expired token');
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
}
