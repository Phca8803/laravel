<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\JournalNew;
use App\Rules\JournalNewRule;
use Illuminate\Foundation\Http\FormRequest;

class JournalNewUpdateRequest extends FormRequest
{
    public function rules()
    {

        $rules = JournalNewRule::rules();
        $rules['title'] = str_replace('required','nullable',$rules['title']);
        $rules['text'] = str_replace('required','nullable',$rules['text']);
        return $rules;
    }

    public function messages()
    {
        return JournalNewRule::messages();
    }
}