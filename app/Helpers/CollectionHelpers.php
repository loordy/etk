<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 22.01.2019
 * Time: 17:35
 */

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;


class CollectionHelpers
{

    public static function getExpirience(Collection $lcs)
    {
        $expirience = 0;

        foreach ($lcs as $lc) {
            if ($lc->main_work_lc and $lc->active_lc and $lc->direct_lc) {
                $diff = $lc->date_start_lc->endOfMonth()->diffAsCarbonInterval(is_null($lc->date_end_lc) ? Carbon::now() : $lc->date_end_lc->startOfMonth());
                $expirience += $diff->y * 12;
                $expirience += $diff->m;
                if ($diff->d > 14) {
                    if ($lc
                            ->date_start_lc
                            ->diffInDays($lc
                                ->date_start_lc
                                ->endOfMonth()) > 14) {
                        $expirience += 1;
                    }
                    if ($lc
                            ->date_end_lc
                        and $lc
                            ->date_end_lc
                            ->diffInDays($lc
                                ->date_end_lc
                                ->startOfMonth())  > 14) {
                        $expirience += 1;
                    }
                }
            }
        }

        return $expirience;
    }

}