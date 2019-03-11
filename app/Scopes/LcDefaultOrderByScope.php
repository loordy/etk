<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 17.09.2018
 * Time: 15:36
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LcDefaultOrderByScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder;
            //->where('active_lc',true)
            //->where('date_end_lc',null)
            //->orderBy('date_start_lc','asc');
    }
}