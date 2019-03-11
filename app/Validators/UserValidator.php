<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class UserValidator
 * @package App\Validators
 */
class UserValidator extends BaseValidator
{
    /**
     * @var User
     */
    private $repository;

    /**
     * UserValidator constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->repository = $user;

    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateUser($attribute, $value, $parameters, $validator)
    {

        if($value === Auth::id()){
            return true;
        }

        $user = $this->repository->findOrFail($value);

        if(isset($parameters[0])){
            $string = '_'.$parameters[0];
        }else{
            $string = null;
        }


        return Gate::allows('update'.$string,$user);

    }



}