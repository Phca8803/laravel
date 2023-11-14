<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Auth;

class UserService
{
    public function paginate($limit): LengthAwarePaginator
    {
        return $this->buildQuery()->paginate($limit);
    }

    private function buildQuery(): Builder
    {
        $query = User::query();
  
        $query->when(request('id'), function($query,$id){
            return $query->whereId($id);
        });

        if(request('name')){
            $query->when('name', function($query){
                return $query->where('name','LIKE','%' . request('name') . '%');
            });
        }

        if(request('email')){
            $query->when('email', function($query){
                return $query->where('email','LIKE','%' . request('email') . '%');
            });
        }
        
        return $query;
    }

    public function create($data): User
    {
        $user = new User();
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function update($data, User $user): User 
    {
        $user->fill($data);
        $user->password = Hash::make($data['password']); 
        $user->save();

        return $user;
    }

    public function delete(User $user){
        
        return $user->delete();
    }

}