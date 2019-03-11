<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class StructureValidator
 * @package App\Validators
 */
class StructureValidator extends BaseValidator
{
    /**
     * @var Structure
     */
    private $model;

    /**
     * StructureValidator constructor.
     * @param Structure $structure
     */
    public function __construct(Structure $structure)
    {
        $this->model = $structure;

    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateStructure($attribute, $value, $parameters, $validator)
    {

        $structure = $this->model->findOrFail($value);

        return Gate::allows('use',$structure);

    }



}