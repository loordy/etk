<?php

namespace App\Repositories\v1;

use App\Models\v1\Structures;
use App\Models\v1\Positions;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Cache;
use App\Events\RepositoryEntityCreated;
use App\Events\RepositoryEntityUpdated;
use App\Events\RepositoryEntityDeleted;
use Illuminate\Support\Facades\Gate;
use App\Helpers\DateRange;

/**
 * Class StructuresRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:10 am UTC
 *
 * @method Structures findWithoutFail($id, $columns = ['*'])
 * @method Structures first($columns = ['*'])
 */
class StructuresRepository extends BaseApiv1Repository
{

    /**
     * @var int
     */
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
        return Structures::class;
    }

    /**
     * Get soato
     *
     * @param string $pin
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function getStructureByTin($tin)
    {
        // return Cache::tags([$tin,get_class($this->model)])->remember('getUsersByPin',$this->getCacheMinutes(), function ()  use ($tin){
        return $this->model->where('tin_company_structure', $tin)->orderBy('id_structure', 'asc')->get();
        // });
    }


    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {

        $parent = $this->find($attributes['parent_id_structure']);

        if ($parent === 404) {
            $this->resetModel();
            return 404;
        }

        if ($parent === 403) {
            $this->resetModel();
            return 403;
        }

        $model = $this->find($id);

        if ($model === 404) {
            $this->resetModel();
            return 404;
        }


        if (Gate::denies('update-structure', $model)) {
            $this->resetModel();
            return 403;
        };

        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityUpdated(null, $model->tin_company_structure, null, get_class($this->model)));

        return $model;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|int|mixed
     */
    public function create(array $attributes)
    {

        //TODO просмотреть в будущем, очень плохо написано, на вьюшках уже будет интереснее
        $parent = $this->find($attributes['parent_id_structure']);

        if ($parent === 404) {
            $this->resetModel();
            return 404;
        }

        if ($parent === 403) {
            $this->resetModel();
            return 403;
        }


        $model = $this->model->fill($parent->toArray());


        if (Gate::denies('create-structure', $model)) {
            $this->resetModel();
            return 403;
        };

        $model->fill($attributes);

        if (!DateRange::inRange($parent->date_start_structure, $parent->date_end_structure, $model->date_start_structure, $model->date_end_structure)) {
            return 424;
        }

        $model->save();
        $this->resetModel();

        event(new RepositoryEntityCreated(null, $model->tin_company_structure, null, get_class($this->model)));

        return $model;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $model = $this->model->find($id, $columns);

        if (empty($model)) {
            $this->resetModel();
            return 404;
        }


        if (Gate::denies('show-structure', $model)) {
            $this->resetModel();
            return 403;
        }

        $this->resetModel();

        return $model;
    }


    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {

        $model = $this->find($id);

        if ($model === 404) {
            $this->resetModel();
            return 404;
        }

        if ($model === 403) {
            $this->resetModel();
            return 403;
        }


        $this->resetModel();
        if ($model) {

            if (!$model->parent_id_structure) {
                abort('424', 'U cant delete root structure');
            }

            $modelNested = $this->model->where('parent_id_structure', $id)->first();

            if (!empty($modelNested)) {
                abort('424', 'U must delete nested structures first');
            }

            $modelPositions = Positions::where('id_structure_position', $id)->first();

            if (!empty($modelPositions)) {
                abort('424', 'U must delete nested positions first');
            }

            $deleted = $model->delete();
            //event(new RepositoryEntityDeleted(null, $model->tin_orgstruct, null, get_class($this->model)));
            return $deleted;
        }

    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createRoot(array $attributes)
    {
        $model = $this->model->fill($attributes);
        $model->save();
        $this->resetModel();
        return $model;
    }


}
