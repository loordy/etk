<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 11.02.2019
 * Time: 9:15
 */

namespace App\Services\v2;


use App\Models\v2\Position;

class CheckPositionForUpdate
{
    public static function check(Position $position){
        if(!empty($position->ActiveTransaction)){
            abort(403,'Close active contract first');
        }
    }
}