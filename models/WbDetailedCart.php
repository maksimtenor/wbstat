<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\UrlConstructor;
use app\models\Apikeys;
use app\models\User;

/** Детальная статистика по корзине */
class WbDetailedCart
{
    public $articul;
    public $date_from;
    public $date_to;
    public $aggregationLevel;
    public $date = '';
    public $articule = '';
    public $name = '';
    public $vendorCode = '';
    public $openCardCount = 0;
    public $addToCartCount = 0;
    public $addToCartConversion = 0;
    public $ordersCount = 0;
    public $ordersSumRub = 0;
    public $cartToOrderConversion = 0;
    public $buyoutsCount = 0;
    public $buyoutsSumRub = 0;
    public $buyoutPercent = 0;

    public function getDetailHistory($articul,$date_from,$date_to,$aggregationLevel){
        $get_data = array(
            'nmIDs' => [
                (int)$articul,
            ],
            'period' => [
                'begin' => $date_from,
                'end' => $date_to
            ],
            'aggregationLevel' => $aggregationLevel
        );
//        print_r($get_data);
        $json_data = json_encode($get_data);

        $ch = curl_init(); // создаем экземпляр curl
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:' . Apikeys::findByUserid(Yii::$app->user->identity->getId())->getKey(),
            'Content-Type:application/json',
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, UrlConstructor::UrlDetailHistory());

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);
//        print_r($res);
        $count = 1;
        if(isset($res['data'])){
            foreach ($res['data'] as $value){
                $this->articule = $value['nmID'];
                $this->name = $value['imtName'];
                $this->vendorCode = $value['vendorCode'];
                $this->date = $date_from.' - '.$date_to;
                $this->openCardCount = 0;
                $this->addToCartCount = 0;
                $this->addToCartConversion = 0;
                $this->ordersCount = 0;
                $this->ordersSumRub = 0;
                $this->cartToOrderConversion = 0;
                $this->buyoutsCount = 0;
                $this->buyoutsSumRub = 0;
                $this->buyoutPercent = 0;
                foreach ($value['history'] as $history){
                    $this->openCardCount += $history['openCardCount'];
                    $this->addToCartCount += $history['addToCartCount'];
                    $this->addToCartConversion += $history['addToCartConversion'];
                    $this->ordersCount += $history['ordersCount'];
                    $this->ordersSumRub += $history['ordersSumRub'];
                    $this->cartToOrderConversion += $history['cartToOrderConversion'];
                    $this->buyoutsCount += $history['buyoutsCount'];
                    $this->buyoutsSumRub += $history['buyoutsSumRub'];
                    $this->buyoutPercent += $history['buyoutPercent'];
                }

                $count++;
            }
        }
        return [
            'articule' => $this->articule,
            'name' => $this->name,
            'vendorCode' => $this->vendorCode,
            'date' => $this->date,
            'openCardCount' => $this->openCardCount,
            'addToCartCount' => $this->addToCartCount,
            'addToCartConversion' => $this->addToCartConversion,
            'ordersCount' => $this->ordersCount,
            'ordersSumRub' => $this->ordersSumRub,
            'cartToOrderConversion' => $this->cartToOrderConversion,
            'buyoutsCount' => $this->buyoutsCount,
            'buyoutsSumRub' => $this->buyoutsSumRub,
            'buyoutPercent' => $this->buyoutPercent,
        ];
    }

//    public function getArticul($res){
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                return $this->articule = $value['nmID'];
//            }
//        }
//    }
//    public function getName($res){
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                return $this->name = $value['imtName'];
//            }
//        }
//    }
//    public function getVendorCode($res){
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                return $this->vendorCode = $value['vendorCode'];
//            }
//        }
//    }
//    public function getDates($res){
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                return $this->date = $this->date_from.' - '.$this->date_to;
//            }
//        }
//    }
//    public function getOpenCardCount($res){
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                foreach ($value['history'] as $history){
//                    $this->openCardCount += $history['openCardCount'];
//                }
//                return $this->openCardCount;
//            }
//        }
//    }



//    public function getData($res){
//        $count = 1;
//        if(isset($res['data'])){
//            foreach ($res['data'] as $value){
//                $articule = $value['nmID'];
//                $name = $value['imtName'];
//                $vendorCode = $value['vendorCode'];
//                $date = $this->date_from.' - '.$this->date_to;
//                $openCardCount = 0;
//                $addToCartCount = 0;
//                $addToCartConversion = 0;
//                $ordersCount = 0;
//                $ordersSumRub = 0;
//                $cartToOrderConversion = 0;
//                $buyoutsCount = 0;
//                $buyoutsSumRub = 0;
//                $buyoutPercent = 0;
//                foreach ($value['history'] as $history){
//                    $openCardCount += $history['openCardCount'];
//                    $addToCartCount += $history['addToCartCount'];
//                    $addToCartConversion += $history['addToCartConversion'];
//                    $ordersCount += $history['ordersCount'];
//                    $ordersSumRub += $history['ordersSumRub'];
//                    $cartToOrderConversion += $history['cartToOrderConversion'];
//                    $buyoutsCount += $history['buyoutsCount'];
//                    $buyoutsSumRub += $history['buyoutsSumRub'];
//                    $buyoutPercent += $history['buyoutPercent'];
//                }
//
//                $count++;
//            }
//            return [
//              'articule' => $articule,
//              'name' => $name,
//              'vendorCode' => $vendorCode,
//              'date' => $date,
//              'openCardCount' => $openCardCount,
//              'addToCartCount' => $addToCartCount,
//              'addToCartConversion' => $addToCartConversion,
//              'ordersCount' => $ordersCount,
//              'ordersSumRub' => $ordersSumRub,
//              'cartToOrderConversion' => $cartToOrderConversion,
//              'buyoutsCount' => $buyoutsCount,
//              'buyoutsSumRub' => $buyoutsSumRub,
//              'buyoutPercent' => $buyoutPercent,
//            ];
//        }
//    }

}