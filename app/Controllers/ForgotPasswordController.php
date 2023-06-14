<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;


class ForgotPasswordController extends BaseController
{
    public function index()
    {
        return view('forgot_password');
    }

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
        $email->setFrom('admin@xid.com', 'XID Email');
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

}
