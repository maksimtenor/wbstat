<?php

namespace app\models;

use Yii;
use yii\base\Model;


class WbDetailedCartForm extends Model
{
    public $articul;
    public $date_from;
    public $date_to;
    public $aggregationLevel = 'month';


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Обязательные к заполнению поля
            [['articul', 'date_from','date_to'], 'required'],
            // Параметры полей
            ['articul', 'integer'],
            ['date_from', 'date'],
            ['date_to', 'date'],
        ];
    }

}
