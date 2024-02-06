<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Users;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $query = Users::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $users = $query->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'users' => $users,
            'pagination' => $pagination,
        ]);

    }
}