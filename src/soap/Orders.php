<?php 
namespace AppWidget\soap;

use AppWidget\config\Config;
use AppWidget\dict\StatusFactory;

class Orders {
    private $clientLogin;
    private $orderID;

    public function __construct($clientLogin, $orderID){
        $this->clientLogin = $clientLogin;
        $this->orderID = $orderID;
    }
    public function createRequest(){
        $request = [];
        $request['get'] = [];
        $request['get']['authenticate'] = [];
        $request['get']['authenticate']['userLogin'] = Config::WSDL_LOGIN;
        $request['get']['authenticate']['authenticateKey'] = sha1(date('Ymd') . sha1(Config::WSDL_PASSWORD));
        $request['get']['params'] = [];
        $request['get']['params']['clients'] = [];
        $request['get']['params']['clients'][0] = [];
        $request['get']['params']['clients'][0]['clientLogin'] = $this->clientLogin;
        $request['get']['params']['ordersSerialNumbers'] = [];
        $request['get']['params']['ordersSerialNumbers'][0] = $this->orderID;
        
        return $request;
    }
    public function getStatusFromResponse(){
        $wsdl = Config::WSDL_PATH . '/wsdl';
        $binding = array();
        $binding['location'] = Config::WSDL_PATH;
        $binding['trace'] = true;
        $client = new \SoapClient($wsdl, $binding);
        $response = $client->__call('get', $this->createRequest());
        
        if ($response->errors->faultCode === 0 ){
            $dFactory = new StatusFactory();
            $statusDictValues = $dFactory->createDict()->getValues();
            $orderStatusSlug = $response->Results[0]->orderDetails->orderStatus;
            if (isset($statusDictValues[$orderStatusSlug])){
                return [
                    'found' => 1,
                    'status' => $statusDictValues[$orderStatusSlug]
                ];
            }
            return [
                'found' => 1,
                'status' => $orderStatusSlug
            ];
        }
        return [
            'found' => 0,
            'msg' => $response->errors->faultString
        ];
    }
}