<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\JournalNew;
use App\Rules\JournalNewRule;
use Illuminate\Foundation\Http\FormRequest;

class JournalNewStoreRequest extends FormRequest
{
    public function rules()
    {
        return JournalNewRule::rules();
    }

    public function messages()
    {
        return JournalNewRule::messages();
    }
}