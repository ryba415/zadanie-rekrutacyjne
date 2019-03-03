<?php
namespace app\models;

use Yii;

class JobOffer //extends \yii\db\ActiveRecord
{
    private $id;
    private $title;
    
    public function __get($atributeName){
        if (property_exists ($this, $atributeName)){
            return $this->$atributeName;
        } else {
            throw new Exception('Atrybute ' . $atributeName . ' does not exist');
        }
    }
    
    public function __set($atributeName, $atributeValue){
        if (property_exists ($this, $atributeName)){
            $this->$atributeName = $atributeValue;
        } else {
            throw new Exception('Atrybute ' . $atributeName . ' does not exist');
        }
    }
    
    
    
    public function rules()
    {
        return [
            [['admin_id', 'company_name', 'name', 'surname', 'specjality', 'province', 'city', 'description'], 'required', 'message' => '{attribute} jest polem obowiązkowym'],   
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => 'Tytuł',
        ];
    }
}