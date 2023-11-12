<?php

declare(strict_types=1);

namespace App\Rules;

class UserRule
{
    protected static $rules = [
        'id' => 'required',
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ];

    public static function rules(){

        return [
            'name' => self::$rules['name'],
            'email' => self::$rules['email'],
            'password' => self::$rules['password'],
        ];
    }

    public static function messages(){

        return [];
    
    }

}