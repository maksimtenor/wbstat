<?php

namespace app\models;
use Yii;
class Sales extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{sales}}';
    }


}
