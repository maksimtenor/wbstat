<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\User;
use app\models\Apikeys;
use app\models\WbArticules;
class ProfileController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', []);

    }
    public function actionMykeys()
    {
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            $model = Apikeys::findByUserid($user->getId());
            return $this->render('mykeys', [
                'model' => $model,
            ]);
        }
    }
}