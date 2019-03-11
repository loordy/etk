<?php /** @noinspection PhpUndefinedMethodInspection */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->put('/api/v2/users/change_password/{pin:[0-9]{14}}', [
    'middleware' => ['cors', 'throttle'],
    'uses' => '\App\Http\Controllers\API\v2\UsersAPIController@changePassword']);

$router->group(['prefix' => 'oauth', 'namespace' => '\App\Passport\Http\Controllers', 'middleware' => ['cors', 'throttle']], function () use ($router) {

    $router->post('/token', 'AccessTokenController@issueToken');

});

$router->group(['prefix' => 'api', 'middleware' => ['cors', 'throttle', 'auth:api','cestn']], function () use ($router) {

    $router->group(['prefix' => 'v2', 'namespace' => 'API\v2',], function () use ($router) {

        $router->get('profile/', 'UsersAPIController@profile');

        //загрузка аватар пользователя
        $router->post('profile/avatar', 'FilesAPIController@avatar');

        /*
         * Котроллер подтверждений договора
         */

        $router->post('transactions/approve/', 'ApproveCodesAPIController@store');

        $router->put('transactions/approve/', 'ApproveCodesAPIController@update');

        $router->group(['prefix' => 'co', 'middleware' => 'can:co'], function () use ($router) {

            /**
             * Контроллер департаментов
             */

            $router->get('structures/', 'StructuresAPIController@index');

            $router->get('structures/{id:[0-9]+}', 'StructuresAPIController@show');

            $router->put('structures/{id:[0-9]+}', 'StructuresAPIController@update');

            $router->post('structures/', 'StructuresAPIController@store');

            $router->delete('structures/{id:[0-9]+}', 'StructuresAPIController@destroy');

            /**
             * Контроллер транзакций
             */

            $router->get('transactions/', 'TransactionsAPIController@index');

            $router->get('transactions/{id:[0-9]+}', 'TransactionsAPIController@show');

            $router->put('transactions/{id:[0-9]+}', 'TransactionsAPIController@update');

            $router->post('transactions/{id:[0-9]+}/mistake', 'TransactionsAPIController@mistake');

            $router->post('transactions/{id:[0-9]+}/improve', 'TransactionsAPIController@improve');

            $router->post('transactions/{id:[0-9]+}/stop', 'TransactionsAPIController@stop');

            $router->put('transactions/{id:[0-9]+}/order', 'TransactionsAPIController@updateOrder');

            $router->post('transactions/', 'TransactionsAPIController@store');

            /**
             * Контроллер должностей
             */

            $router->get('positions/', 'PositionsAPIController@index');

            $router->get('positions/{id:[0-9]+}', 'PositionsAPIController@show');

            $router->put('positions/{id:[0-9]+}', 'PositionsAPIController@update');

            $router->post('positions/', 'PositionsAPIController@store');

            $router->delete('positions/{id:[0-9]+}', 'PositionsAPIController@destroy');

            /**
             * Контроллер компаний
             */

            $router->get('companies/{tin:[0-9]{9}}', 'CompaniesAPIController@show');

            $router->get('companies/{tin:[0-9]{9}}/statistic/', 'CompaniesAPIController@statistic');

            /**
             * Контроллер позиций с активными транзакциями
             */

            $router->get('positions_with_active_transaction/', 'PositionsWithActiveTransactionAPIController@index');

            /**
             * Контроллер контрактов
             */

            $router->get('contracts/', 'ContractsAPIController@index');

            $router->get('contracts/{id:[0-9]+}', 'ContractsAPIController@show');

            $router->get('contracts/archive/', 'ArchiveContractsAPIController@index');

            /**
             * Контроллер приказов
             */

            $router->get('orders/', 'OrdersAPIController@index');

            $router->get('orders/{id:[0-9]+}', 'OrdersAPIController@show');

            $router->post('orders/', 'OrdersAPIController@store');

            $router->put('orders/', 'OrdersAPIController@update');

            /**
             * Контроллер внешних данных
             */

            $router->get('individs/', 'IndividsAPIController@index');

        });

        $router->group(['prefix' => 'citizen', 'middleware' => 'can:citizen'], function () use ($router) {

            $router->get('workbook/', 'TransactionsAPIController@workbook');

        });

        $router->group(['prefix' => 'reports'], function () use ($router) {

            /**
             * Контроллер отчетов
             */

            $router->get('base/{soato}', 'ReportsAPIController@getStatistic');

            $router->get('basebysoato', 'ReportsAPIController@getStatisticBySoato');

        });

        $router->group(['prefix' => 'helpers'], function () use ($router) {

            /**
             * Контроллер констант
             */

            $router->get('soatos/', 'SoatosAPIController@index');

            $router->get('kodps/', 'KodpsAPIController@index');

            $router->get('nskzs/', 'NskzsAPIController@index');

            $router->get('constants/', 'ConstantsAPIController@index');

        });

    });

});