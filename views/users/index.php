<?php
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
?>
    <h1>Список пользователей:</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?= Html::encode("{$user->id_user} ({$user->username})") ?>:
                <?= $user->email ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <img src="" alt="">

<?= LinkPager::widget(['pagination' => $pagination]) ?>