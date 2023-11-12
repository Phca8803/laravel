<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {

        $rules = UserRule::rules();
        $rules['name'] = str_replace('required','nullable',$rules['name']);
        $rules['email'] = str_replace('required','nullable',$rules['email']);
        $rules['password'] = str_replace('required','nullable',$rules['name']);
        return $rules;
    }

    public function messages()
    {
        return UserRule::messages();
    }
}