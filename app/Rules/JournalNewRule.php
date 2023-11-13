<?php

declare(strict_types=1);

namespace App\Rules;

class JournalNewRule
{
    protected static $rules = [
        'id' => 'required',
        'title' => 'required',
        'text' => 'required',
      
    ];

    public static function rules(){

        return [
            'title' => self::$rules['title'],
            'text' => self::$rules['text'],
        ];
    }

    public static function messages(){

        return [];
    
    }

}