<?php

namespace app\models;
use Yii;

class UrlConstructor
{
    private static $urlStats = 'https://statistics-api.wildberries.ru/';
    private static $urlContent = 'https://suppliers-api.wildberries.ru/';
    private static $incomes = 'api/v1/supplier/incomes';
    private static $detailsV1 = 'api/v1/supplier/reportDetailByPeriod';
    private static $detailsV2 = 'api/v2/supplier/reportDetailByPeriod';
    private static $wborders = 'api/v1/supplier/orders';
    private static $taskCreate = 'api/v1/delayed-gen/tasks/create';
    private static $taskStatus = 'api/v1/delayed-gen/tasks';
    private static $taskDownload = 'api/v1/delayed-gen/tasks/download';
    private static $cardsList = 'content/v2/get/cards/list';
    private static $detailHistory = 'content/v1/analytics/nm-report/detail/history';

    public static function UrlStatistic(){
        return self::$urlStats;
    }
    public static function UrlIncomes(){
        return  self::$urlStats . self::$incomes;
    }
    public static function UrlDetails(){
        return  self::$urlStats .  self::$detailsV1;
    }
    public static function UrlDetail2(){
        return self::$urlStats . self::$detailsV2;
    }
    public static function UrlOrders(){
        return self::$urlStats . self::$wborders;
    }
    public static function UrlTaskCreate(){
        return self::$urlStats . self::$taskCreate;
    }
    public static function UrlTaskStatus(){
        return self::$urlStats . self::$taskStatus;
    }
    public static function UrlTaskDownload(){
        return self::$urlStats . self::$taskDownload;
    }
    public static function UrlContent(){
        return self::$urlContent;
    }
    public static function UrlCardsList(){
        return self::$urlContent . self::$cardsList;
    }
    public static function UrlDetailHistory(){
        return self::$urlContent . self::$detailHistory;
    }
}
