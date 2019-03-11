<?php

namespace App\Repositories\v1;

use App\Models\v1\Errors;
use Illuminate\Support\Facades\Cache;
use App\Events\RepositoryEntityCreated;
use App\Events\RepositoryEntityUpdated;
use App\Events\RepositoryEntityDeleted;

/**
 * Class ErrorsRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:12 am UTC
 *
 * @method Errors findWithoutFail($id, $columns = ['*'])
 * @method Errors first($columns = ['*'])
*/
class ErrorsRepository extends BaseApiv1Repository
{

    protected $cacheMinutes = 43200;
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Errors::class;
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

    public function all()
    {
        return Cache::tags(['constants'])->remember('errors',$this->getCacheMinutes(), function () {
            return $this->model->get();
        });
    }
}
