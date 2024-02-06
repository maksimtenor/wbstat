<?php

namespace app\models;
use Yii;
use app\models\User;
class Apikeys extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{api_keys}}';
    }
    public function getKey(){
        return $this->api_key;
    }
    public static function findByUserid($id)
    {
        $apiKey = self::find()->where(['id_user' => $id])->one();
        if (strcasecmp($apiKey->id_user, $id) === 0) {
            return new static($apiKey);
        }
        return null;
    }

}
