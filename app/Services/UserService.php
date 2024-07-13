<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = User::STUDENT;
            $data['status'] = true;

            return User::create($data);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

    public function update($data, User $user)
    {
        try {
            $user->update($data);
            return $user;
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}
