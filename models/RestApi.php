<?php
namespace app\models;

use Yii;


class RestApi implements ApiPrivider{
    
    protected $apiUrl;
    protected $response = '';
    protected $requestStatus;
    protected $errors;
    
    use \app\models\JsonHelper;
    
    public function apiConnect(){
        $this->errors = [];
        $this->requestStatus = false;
        $curl = new Curl($this->apiUrl);
        if ($curl->getUrlResponse()){
            $this->response = $curl->responseString;
            $this->requestStatus = true;
        } else {
            $this->errors = $curl->errors;
        }

        return $this->requestStatus;
    }
    
    public function covertJsonStringToArray(){
        $responseArray = [];
        if ($this->response != '' && $this->isJson($this->response)){
            //var_dump($this->response); die();
            $responseArray = json_decode($this->response, true);
            //var_dump($responseArray); die();
        }

        return $responseArray;
    }
}

