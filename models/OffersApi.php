<?php
namespace app\models;

use Yii;
use app\models\JobOffer;

class OffersApi extends RestApi implements ApiPrivider{

    private $offersCount;
    private $offerFields = ['id'=> 'id', 'admin_name' => 'title'];
    
    public function __construct() {
        $this->apiUrl = Yii::$app->params['offersApiUrl'];
    }
    
    public function getOffersModels(){
        $this->offersCount = 0;
        $offers = [];
        if ($this->response != ''){
            $offersArray = $this->covertJsonStringToArray();
            if (!empty($offersArray['success']) && $offersArray['success']){
                $this->offersCount = count($offersArray['data']);
                foreach ($offersArray['data'] as $offerData){
                    $jobOffer = new JobOffer();
                    foreach ($this->offerFields as $apiName => $className){
                        if (!empty($offerData[$apiName]) && property_exists ($jobOffer, $className)){  //  
                            $jobOffer->$className = $offerData[$apiName];
                        }
                    }
                    $offers[] = $jobOffer;
                }
            }
            
        }

        return $offers;
    }
}

