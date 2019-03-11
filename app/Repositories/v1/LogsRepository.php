<?php

namespace App\Repositories\v1;

use App\Models\v1\Logs;



/**
 * Class LogsRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:11 am UTC
 *
*/
class LogsRepository extends BaseApiv1Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_log',
        'id_user',
        'user_pin_log',
        'user_tin_log',
        'time_log',
        'sql_table',
        'sql_operation',
        'sql_row_id',
        'sql_old_value',
        'sql_new_value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Logs::class;
    }

    public function update(array $attributes, $id)
    {

    }

    public function create(array $attributes)
    {

    }

    public function find($id, $columns = ['*'])
    {

    }


    public function delete($id)
    {

    }
}
