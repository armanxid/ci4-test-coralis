<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Entity\Cast\StringCast;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        // Validate input
        $validationRules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'profile_picture' => 'uploaded[profile_picture]|max_size[profile_picture,1024]|is_image[profile_picture]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $profilePicture = $this->request->getFile('profile_picture');
        $newFileName = $profilePicture->getRandomName();
        $profilePicture->move(ROOTPATH . 'public/uploads', $newFileName);
        $getPassword = $this->request->getPost('password');

        // Create new user
        $userModel = new UserModel();
        $user = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($getPassword, PASSWORD_DEFAULT),
            'profile_picture' => $newFileName
        ];
        $userModel->insert($user);

        return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
    }
}
