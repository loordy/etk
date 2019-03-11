<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function testUserAuth()
    {
        $this->markTestIncomplete(
            'Этот тест ещё не реализован.'
        );
        return;
        $username = 80000000000000 + rand(1, 10000000);
        $data = [
            'grant_type' => 'password',
            'client_id' => '15',
            'client_secret' => 'Mfoam6h0VgoMPF6OxCKFi8GRRpanVcIAg0zHaufs',
            'username' => ''.$username,
            'password' => '123456',
            'scope' => '',
        ];
        $this->post('/oauth/token', $data);

        $this->seeInDatabase('users', ['pin_user' => $username]);

        $this->get('/api/v1/user/');
        $this->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'active_user',
                'tax_person_user',
                'pin_user',
                'tin_company_user',
                'soato_company_user',
                'is_admin_user',
                'mobile_user',
                'home_tel_user',
                'user_oked_user',
                'token_user',
                'soato_minlab_user',
                'family_person_user',
                'name_person_user',
                'middlename_person_user',
                'data_user',
                'type_user',
                'visible_data_user',
                'ml_right_user',
                'su_right_user',
                'email_user',
            ]
        ]);

    }

    /**
     * @dataProvider additionUserCompanyProvider
     */

    public function testUserCompanyAuth($username, $password, $status = 200)

    {
        $json = json_decode('{
            "grant_type" : "password",
            "client_id" : "15",
            "client_secret" : "Mfoam6h0VgoMPF6OxCKFi8GRRpanVcIAg0zHaufs",
            "username" : ' . $username . ',
            "password" : ' . $password . ',
            "scope" : ""
        }');

        $this->post('/oauth/token', (array)$json)->assertResponseStatus($status);

    }

    public function additionUserCompanyProvider()
    {
        /*
         * для ЮЛ
         * |USERNAME|PASSWORD|STATUS - ответа|*/

        $usernameLess8 = 99999999;
        $passwordLess8 = 99999999;
        $usernameMore10 = 1000000000;
        $passwordMore10 = 1000000000;

        /*достаточная длина*/
        $username = 999999999;
        $password = 999999999;

        /*Существуюшая компания*/
        $usernameExistCompany = 487007221;
        $passwordExistCompany = 206805048;

        /*Несуществуюшая компания*/
        $usernameNoExistCompany = 487007226;
        $passwordNoExistCompany = 206805778;

        return [
            '(String) Превышена длина логина и пароля' => ['"' . $usernameMore10 . '"', '"' . $passwordMore10 . '"', 401],
            '(String) Превышена длина пароля' => ['"' . $username . '"', '"' . $passwordMore10 . '"', 401],
            '(String) Превышена длина логина' => ['"' . $usernameMore10 . '"', '"' . $password . '"', 401],
            '(String) Недостаточная длина логина и пароля' => ['"' . $usernameLess8 . '"', '"' . $passwordLess8 . '"', 401],
            '(String) Недостаточная длина пароля' => ['"' . $username . '"', '"' . $passwordLess8 . '"', 401],
            '(String) Недостаточная длина логина' => ['"' . $usernameLess8 . '"', '"' . $password . '"', 401],
            '(String) Существующие данные компании' => ['"' . $usernameExistCompany . '"', '"' . $passwordExistCompany . '"'],
            '(String) Несуществующие данные компании' => ['"' . $usernameNoExistCompany . '"', '"' . $passwordNoExistCompany . '"', 404],
            '(String) Cтроки вместо логина и пароля' => ['username', 'password', 400],
            '(String) Cтрока вместо логина' => ['username', '', 400],
            '(String) Cтрока вместо пароля' => ['', 'password', 400],
            '(String) Пустые параметры' => ['', '', 400],
            '(Int) Недостаточная длина логина и пароля' => [$usernameLess8, $passwordLess8, 401],
            '(Int) Недостаточная длина пароля' => [$username, $passwordLess8, 401],
            '(Int) Недостаточная длина логина' => [$usernameLess8, $password, 401],
            '(Int) Превышена длина логина и пароля' => [$usernameMore10, $passwordMore10, 401],
            '(Int) Превышена длина пароля' => [$username, $passwordMore10, 401],
            '(Int) Превышена длина логина' => [$usernameMore10, $password, 401],
            '(Int) Существующие данные компании' => [$usernameExistCompany, $passwordExistCompany],
            '(Int) Несуществующие данные компании' => [$usernameNoExistCompany, $passwordNoExistCompany, 404],
        ];
    }
}
