<?php

/**
 * Class TestCase
 */
abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://etkbacklumen';

//    /**
//     * @return mixed
//     */
//    function getHeaders($tin = null, $username = '10100000000010')
//    {
//        if($tin){
//            $tinstr = '"tin":"'.$tin.'",';
//        }
//        $json = json_decode('{
//    "grant_type" : "password",
//    "client_id" : "15",
//    "client_secret" : "Mfoam6h0VgoMPF6OxCKFi8GRRpanVcIAg0zHaufs",
//    "user_pin_user" : "10",
//    "username" : '.$username.',
//    "password" : "123456",
//    '.$tinstr.'
//    "scope" : ""
//}');
//        $this->post('/oauth/token', (array)$json);
//        $headers['Authorization'] = 'Bearer '.json_decode($this->response->getContent())->access_token;
//        $headers['Content-Type'] = 'application/json';
//        return $headers;
//    }
}
