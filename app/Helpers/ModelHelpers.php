<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 06.03.2019
 * Time: 17:42
 */

namespace App\Helpers;


use App\Models\v2\BaseModel;

class ModelHelpers
{
    /**
     * @param BaseModel $model
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public static function findWhere(BaseModel $model, array $where, $columns = ['*'])
    {

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $model = $model->where($field, $condition, $val);
            } else {
                $model = $model->where($field, '=', $value);
            }
        }

        return $model->get($columns);

    }


}