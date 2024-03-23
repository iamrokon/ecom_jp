<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Zenkaku implements Rule
{
    public function passes($attribute, $value)
    {
        if(!empty($value) && mb_convert_kana($value, "RNASK") === $value)
        {
            return true;
        }
        return false;
    }
  
    public function message()
    {
        return '【:attribute】全角文字以外は使用できません。';
    }
}
