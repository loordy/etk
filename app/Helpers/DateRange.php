<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 08.12.2018
 * Time: 18:02
 */

namespace App\Helpers;

use Carbon\Carbon;


class DateRange
{

    public static function inRange(Carbon $dateStart = null,
                                   Carbon $dateEnd = null,
                                   Carbon $dateStartCheck = null,
                                   Carbon $dateEndCheck = null)
    {
        //TODO навернео надо убрать вообще
        if ($dateStart && $dateEnd && $dateEnd < $dateStart) {
            abort(424, 'Error with dates.');
        }

        if ($dateStartCheck && $dateEndCheck && $dateEndCheck < $dateStartCheck) {
            abort(424, 'Error with dates.');
        }

        //
        if ($dateStart && $dateEnd && $dateStartCheck && $dateEndCheck) {

            return $dateStartCheck->between($dateStart, $dateEnd) && $dateEndCheck->between($dateStart, $dateEnd);

        } elseif (!$dateStart && $dateEnd && $dateStartCheck && $dateEndCheck) {

            return $dateStartCheck->lte($dateEnd) && $dateEndCheck->lte($dateEnd);

        } elseif (!$dateStart && $dateEnd && !$dateStartCheck && $dateEndCheck) {

            return $dateEndCheck->lte($dateEnd);

        } elseif (!$dateStart && $dateEnd && $dateStartCheck && !$dateEndCheck) {

            return false;

        } elseif (!$dateStart && $dateEnd && !$dateStartCheck && !$dateEndCheck) {

            return false;

        } elseif ($dateStart && !$dateEnd && $dateStartCheck && $dateEndCheck) {

            return $dateStartCheck->gte($dateStart) && $dateEndCheck->gte($dateStart);

        } elseif ($dateStart && !$dateEnd && !$dateStartCheck && $dateEndCheck) {

            return false;

        } elseif ($dateStart && !$dateEnd && $dateStartCheck && !$dateEndCheck) {

            return $dateStartCheck->gte($dateStart);

        } elseif ($dateStart && !$dateEnd && !$dateStartCheck && !$dateEndCheck) {

            return false;

        } elseif (!$dateStart && !$dateEnd && $dateStartCheck && $dateEndCheck) {

            return true;

        } elseif (!$dateStart && !$dateEnd && !$dateStartCheck && $dateEndCheck) {

            return true;

        } elseif (!$dateStart && !$dateEnd && !$dateStartCheck && !$dateEndCheck) {

            return true;

        } elseif (!$dateStart && !$dateEnd && $dateStartCheck && !$dateEndCheck) {

            return true;

        } elseif ($dateStart && $dateEnd && $dateStartCheck && !$dateEndCheck) {

            return false;

        } elseif ($dateStart && $dateEnd && !$dateStartCheck && $dateEndCheck) {

            return false;

        } elseif ($dateStart && $dateEnd && !$dateStartCheck && !$dateEndCheck) {

            return false;
        }
    }

}