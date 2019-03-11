<?php

namespace App\Repositories\v1;

use App\Models\v1\Users;
use Illuminate\Support\Facades\Cache;
use App\Events\RepositoryEntityCreated;
use App\Events\RepositoryEntityUpdated;
use App\Events\RepositoryEntityDeleted;
use Carbon\Carbon;
use App\Services\v2\ExternalCompanyAPIService as Company;
use App\Services\v2\ExternalIndividAPIService as Individ;
use App\Events\SendNotification;


/**
 * Class UsersRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:10 am UTC
 *
 * @method Users findWithoutFail($id, $columns = ['*'])
 * @method Users first($columns = ['*'])
 */
class UsersRepository extends BaseApiv1Repository
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
        return Users::class;
    }

    /**
     * Get users by pin
     *
     * @param string $pin
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function getUsersByPin($pin)
    {
        return Cache::tags([$pin, get_class($this->model)])->remember('getUsersByPin', $this->getCacheMinutes(), function () use ($pin) {
            $model = $this->model->where('pin_user', $pin)->get();
            $this->resetModel();
            return $model;
        });
    }

    /**
     * @param $tin
     * @return mixed
     */
    public function getUsersByTin($tin)
    {
        return Cache::tags([$tin, get_class($this->model)])->remember('getUsersByTin', $this->getCacheMinutes(), function () use ($tin) {
            $model = $this->model->where('tin_company_user', $tin)->get();
            $this->resetModel();
            return $model;
        });
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $attributes)
    {

        $model = $this->model->fill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityCreated($model->pin_user, $model->tin_company_user, null, get_class($this->model)));

        return $model;
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityUpdated($model->pin_user, $model->tin_company_user, null, get_class($this->model)));

        return $model;
    }

    /**
     * @param $id
     * @return int|void
     */
    public function delete($id)
    {
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {

        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $model;
    }

    /**
     * @param $username
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function findForPassport($username, $password)
    {

        //Если это компания
        if ((int)$password > 99999999 and (int)$password < 1000000000 and (int)$username > 99999999 and (int)$username < 1000000000) {
            $companyData = Company::getCompany($password);

            if (is_null($companyData)) {
                abort(404, 'Company not found in external database');
            }

            $user = $this->model->where('tin_company_user', $password)
                ->where('tax_person_user', $username)
                ->first();


            if (!$user) {
                $user = $this->create([
                    'tax_person_user' => $username,
                    'password' => app('hash')->make($password),
                    'soato_company_user' => $companyData['SOATO_CD'],
                    'tin_company_user' => $password,
                    'type_user' => 2,
                    'active_user' => true,
                ]);

            } elseif (!empty($user) && !$user->active_user) {
                abort(401, 'User not active');
            }

            $structuresRepository = new StructuresRepository(app());
            $structure = $structuresRepository->getStructureByTin($password)->first();
            if (!$structure) {

                $structuresRepository
                    ->createRoot([
                        'tin_company_structure' => $password,
                        'name_structure' => $companyData['ACRON_UZ'],
                        'oked_structure' => $companyData['OKED_CD'],
                        'region_structure' => $companyData['SOATO_CD'],
                        'region4_structure' => substr($companyData['SOATO_CD'], 0, 4),
                        'parent_id_structure' => null,
                        'data_structure' => $companyData,
                        'date_start_structure' => Carbon::createFromFormat('dmY', $companyData['REG_DATE']),
                    ]);
            } else {
                $structure->fill([
                    'tin_company_structure' => $password,
                    'name_structure' => $companyData['ACRON_UZ'],
                    'oked_structure' => $companyData['OKED_CD'],
                    'region_structure' => $companyData['SOATO_CD'],
                    'region4_structure' => substr($companyData['SOATO_CD'], 0, 4),
                    'parent_id_structure' => null,
                    'data_structure' => $companyData,
                    'date_start_structure' => Carbon::createFromFormat('dmY', $companyData['REG_DATE']),
                ]);
                $structure->save();
            }

            return $user;

        } elseif ((int)$password > 10000000 and
            (int)$password < 99999999 and
            (int)$username > 9999999999999 and
            (int)$username < 100000000000000
        ) {



            $user = $this->model
                ->where('pin_user', $username)
                ->where('type_user', 1)
                ->first();

            if ($user && !$user->active_user) {
                abort(401, 'User not active');
            }


            return $user;


        } elseif (substr($username, 0, 8) === 'operator') {
            $user = $this->model
                ->where('type_user', 3)
                ->where('tax_person_user', substr($username, 9, 9))
                ->first();
            if (!empty($user) && !$user->active_user) {
                abort(401, 'User not active');
            }

            return $user;
        } elseif (substr($username, 0, 2) === 'su') {
            $user = $this->model
                ->where('type_user', 5)
                ->where('tax_person_user', substr($username, 3, 9))
                ->first();

            if (!empty($user) && !$user->active_user) {
                abort(401, 'User not active');
            }

            return $user;
        } elseif (substr($username, 0, 6) === 'minzto') {
            $user = $this->model
                ->where('type_user', 4)
                ->where('tax_person_user', substr($username, 7, 9))
                ->first();

            if (!empty($user) && !$user->active_user) {
                abort(401, 'User not active');
            }

            return $user;
        }

        return null;

    }


    public function changePassword($pin)
    {

        $model = $this->model->where('pin_user', $pin)
            ->where('type_user',1)
            ->first();
        $this->resetModel();

        if (!$model) {
           abort(404,'User not found');
        }

        if (!$model->mobile_user) {
            abort(404,'User mobile not found');
        }

        $password = rand(10000000, 99999999);

        $model->fill([
            'password' => app('hash')->make($password)
        ]);
        $model->save();

        event(new SendNotification($model->mobile_user, '<EHCT> Parol dlya vhoda ' . $password));


        return $model;

    }

}
