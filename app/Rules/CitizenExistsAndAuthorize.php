<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/**
 * Class ContractExistsAndAuthorize
 * @package App\Rules
 */
class CitizenExistsAndAuthorize implements Rule
{


    /**
     * CitizenExistsAndAuthorize constructor.
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
        if($value === Auth::user()->$attribute){
            return true;
        }

        return Gate::allows('workbook');

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute unauthorized';
    }
}
