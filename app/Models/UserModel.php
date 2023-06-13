<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'profile_picture', 'reset_token', 'reset_token_expires'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function updateUserToken($userId, $token, $expiration)
    {
        return $this->update($userId, [
            'reset_token' => $token,
            'reset_token_expires' => $expiration
        ]);
    }

    public function updateUserPassword($userId, $password)
    {
        return $this->update($userId, [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expires' => null
        ]);
    }

    public function clearUserToken($userId)
    {
        return $this->update($userId, [
            'reset_token' => null,
            'reset_token_expires' => null
        ]);
    }
}
