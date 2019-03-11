<?php

namespace App\Repositories\v1;

use Closure;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Collection;
use App\Validator\Contracts\ValidatorInterface;
use App\Validator\Exceptions\ValidatorException;
use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseApiv1Repository
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $fieldSearchable = [];


    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = null;

    /**
     * Collection of Criteria
     *
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * @var bool
     */
    protected $skipPresenter = false;

    /**
     * @var \Closure
     */
    protected $scopeQuery = null;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->makeValidator();
        $this->boot();
    }

    /**
     *
     */
    public function boot()
    {
        //
    }

    /**
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());


        return $this->model = $model;
    }

    /**
     */
    public function resetModel()
    {
        $this->makeModel();
    }
    /**
     * @param null $validator
     *
     * @return null|ValidatorInterface
     */
    public function makeValidator($validator = null)
    {
        $validator = !is_null($validator) ? $validator : $this->validator();

        if (!is_null($validator)) {
            $this->validator = is_string($validator) ? $this->app->make($validator) : $validator;

            return $this->validator;
        }

        return null;
    }
    /**
     * Specify Validator class name of App\Validator\Contracts\ValidatorInterface
     *
     * @return null
     * @throws Exception
     */
    public function validator()
    {

        if (isset($this->rules) && !is_null($this->rules) && is_array($this->rules) && !empty($this->rules)) {
            if (class_exists('App\Validator\LaravelValidator')) {
                $validator = app('App\Validator\LaravelValidator');
                if ($validator instanceof ValidatorInterface) {
                    $validator->setRules($this->rules);

                    return $validator;
                }
            } else {
                throw new Exception(trans('repository::packages.App_laravel_validation_required'));
            }
        }

        return null;
    }
    /**
     * Get cache minutes
     *
     * @return int
     */
    public function getCacheMinutes()

    {
        $cacheMinutes = isset($this->cacheMinutes) ? $this->cacheMinutes : config('repository.cache.minutes', 30);

        return $cacheMinutes;
    }

    /**
     * Get Searchable Fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

}
