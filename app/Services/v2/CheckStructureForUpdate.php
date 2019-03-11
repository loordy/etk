<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 11.02.2019
 * Time: 9:15
 */

namespace App\Services\v2;


use App\Models\v2\Structure;

class CheckStructureForUpdate
{
    public static function check(Structure $structure)
    {

        if (empty($structure->parent_id)) {
            abort(403, 'U cant update root structure');
        }
        if ($structure->parent_id === $structure->id){
            abort(403, 'U cant set parent_id same as id');
        }
        //TODO рассмотреть логику update structure
    }
}