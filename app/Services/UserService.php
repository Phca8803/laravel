<?php

namespace App\Services;

use App\Models\User;
use Auth;

class UserService
{
    public function create($data): User
    {
        $user = new User();
        $user->fill($data);

        $user->save();

        return $user;
    }

    public function update($data, User $user): User 
    {
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function delete(User $user){
        
        return $user->delete();
    }

}