<?php
namespace app\controllers;

use Yii;
use app\models\Apikeys;
use yii\web\Controller;
use app\models\UrlConstructor;
use app\models\Reports;
use app\models\User;
use app\models\WbArticules;
use app\models\WbDetailedCart;
use app\models\WbDetailedCartForm;
use yii\data\ArrayDataProvider;

use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;


class ReportsController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index', []);
        }
    }
    public function actionArtlist()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new WbArticules();
            $wbArticules = $model->getBDArticles();
            $provider = new ArrayDataProvider([
                'allModels' => $wbArticules,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'attributes' => ['name'],
                ],
            ]);
//            print_r($wbArticules);exit();
            return $this->render('artlist', [
                'model' => $model,
                'wbArticules' => $wbArticules,
                'dataProvider' => $provider,
            ]);
        }
    }

    public function actionWbarticles()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new WbArticules();
            if($model->getWBArticles()){
                $wbArticules = $model->getBDArticles();
                $provider = new ArrayDataProvider([
                    'allModels' => $wbArticules,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'attributes' => ['name'],
                    ],
                ]);
                return $this->redirect(['reports/artlist']);
            }else {
                $this->redirect(['reports/index']);
            }

        }
    }
    public function actionEdit()
    {
        return $this->redirect(['reports/artlist']);
    }
    public function actionCartdetail()
    {
        if (!Yii::$app->user->isGuest) {
            $model = '';
            $cartForm = new WbDetailedCartForm();
            $wbCartDetail = '';
            $data = '';
            if ($cartForm->load(Yii::$app->request->post())) {
                // данные в $model удачно проверены

                // делаем что-то полезное с $model ...
                $model = new WbDetailedCart();
                $wbCartDetail = $model->getDetailHistory($cartForm->articul,$cartForm->date_from,$cartForm->date_to,$cartForm->aggregationLevel);
//                $data = $dataProvider->getData($wbCartDetail);
            }

            return $this->render('cartdetail', [
                    'model' => $model,
                    'cartForm' => $cartForm,
                    'wbCartDetail' => $wbCartDetail
                ]
            );
        }
    }
}