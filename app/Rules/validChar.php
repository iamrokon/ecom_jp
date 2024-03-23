<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validChar implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strpos($value, ',') !== false)
        {
            return false;
        }
        elseif (strpos($value, "'") !== false)
        {
            return false;
        }
        elseif (strpos($value, '"') !== false)
        {
            return false;
        }
        elseif (strpos($value, '!') !== false)
        {
            return false;
        }
        elseif (strpos($value, '%') !== false)
        {
            return false;
        }
        elseif (strpos($value, '&') !== false)
        {
            return false;
        }
        elseif (strpos($value, '*') !== false)
        {
            return false;
        }
        elseif (strpos($value, '\\') !== false)
        {
            return false;
        }
        elseif (strpos($value, '¥') !== false)
        {
            return false;
        }
        elseif (strpos($value, '+') !== false)
        {
            return false;
        }
        elseif (strpos($value, '=') !== false)
        {
            return false;
        }
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "【:attribute】[.][*][=]['][".'"][!][\][+][&][%]は使用できません。';
    }
}
