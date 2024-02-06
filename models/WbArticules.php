<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\UrlConstructor;
use app\models\Apikeys;
use app\models\User;

/** Получение карточек товаров */
class WbArticules extends ActiveRecord
{
//    public $articule;
//    public $name;
//    public $photo;
//    public $date;
//    public $created;
//    public $updated;
    public $wbArrayArt = array();

    public static function tableName()
    {
        return 'wb_articles';
    }

    public function getWBArticles(){
        $get_data = array(
            'settings' => [
                'cursor' => [
                    'limit' => 1000
                ],
                'filter' => [
                    'withPhoto' => -1
                ]
            ]
        );
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
        curl_setopt($ch, CURLOPT_URL, UrlConstructor::UrlCardsList());

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);

//        return $res;
//        echo '<pre>';
//        print_r($res);
//        echo '</pre>';
//        exit();
        if(!empty($res)){
            foreach ($res as $item) {
                foreach ($item as $value){
                    if(isset($value['subjectName'])){
                        $this->articule = $value['nmID'];
                        $this->name = $value['title'];
                        if(isset($value['photos'][0]['big']))
                            $this->photo = $value['photos'][0]['big'];
                        $this->created = date("Y-m-d", strtotime($value['createdAt']));
                        $this->updated = date("Y-m-d", strtotime($value['updatedAt']));

                        $wbArrayArt[] = [
                            'articule' => $this->articule,
                            'name' => $this->name,
                            'photo' => $this->photo,
                            'created' => $this->created,
                            'updated' => $this->updated,
                        ];
                        $wbArt = self::find()->where(['id_user' => Yii::$app->user->identity->getId(), 'articule' => $value['nmID']])->one();
                        if($wbArt){
                            $wbArt->updated = date("Y-m-d", strtotime($value['updatedAt']));
                            if(isset($value['photos'][0]['big'])){
                                $wbArt->photo = $value['photos'][0]['big'];
                            }else{
                                $wbArt->photo = null;
                            }
                            $wbArt->name = $value['title'];
                            $wbArt->update();
//                            echo 'обновить эту запись</br>';
                        }else{
                            $wbArts = new WbArticules();
                            $wbArts->articule = $value['nmID'];
                            $wbArts->name = $value['title'];
                            if(isset($value['photos'][0]['big'])){
                                $wbArts->photo = $value['photos'][0]['big'];
                            }else{
                                $wbArts->photo = null;
                            }
                            $wbArts->created = date("Y-m-d", strtotime($value['createdAt']));
                            $wbArts->updated = date("Y-m-d", strtotime($value['updatedAt']));
                            $wbArts->id_user = Yii::$app->user->identity->getId();
                            $wbArts->insert();
//                            echo 'добавить новую запись</br>';
                        }
                    }
                }
            }
            return true;
        }else {
            return false;
        }
    }

    public function getBDArticles(){
        return $artFind = self::find()->where(['id_user' => Yii::$app->user->identity->getId()])->orderBy('name')->all();
    }
}