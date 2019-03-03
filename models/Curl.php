<?php

namespace app\models;

use Yii;
use yii\db\Exception;

class Curl{
    
    private $host;
    private $myCurl;
    private $errors = []; 
    private $responseString = '';
    private $status = false;
    
    public function __construct($host = null) {
        $this->host = $host;
        $this->errors = [];
        $this->myCurl = curl_init($host);
        curl_setopt($this->myCurl, CURLOPT_TIMEOUT, 5);      /* set curl connection options */
        curl_setopt($this->myCurl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($this->myCurl, CURLOPT_RETURNTRANSFER, true);
    }
    
    public function __destruct(){
        curl_close($this->myCurl);  
    }
    
    public function __get($atributeName){
        if (property_exists ($this, $atributeName)){
            return $this->$atributeName;
        } else {
            throw new Exception('Atrybute ' . $atributeName . ' does not exist');
        }
    }
    
    public function getUrlResponse(){
        $this->errors = [];
        $this->status = false;
        if ($this->host != null && $this->host != ''){
            try {
                $this->responseString = curl_exec($this->myCurl);
                $responseCode = curl_getinfo($this->myCurl)["http_code"];
                if ($responseCode === 200){  /* check url response */
                    $this->status = true;
                } else {
                    $this->errors[] = 'Url response code: ' . $responseCode;
                }
            } catch (Exception $ex) {
                $this->errors[] = new Exception("Invalid URL",0,$e);
            }
        } else {
            $this->errors[] = 'Host can not be empty';
        }
        
        return $this->status;
    }
    
}
