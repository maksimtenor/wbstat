<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    $menuItems[] = ['label' => 'Страницы', 'items' => [ // первый уровень
        ['label' => 'Страницы', 'url' =>['/site/index']], // второй уровень
        ['label' => 'Комментарии', 'url' => ['/site/index']],
        ['label' => 'Теги', 'url' => ['/site/index']],
        ['label' => 'Меню', 'url' => ['/site/index']],
    ]];

    $menuItems[] = [];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right ms-auto'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Отчёты', 'items' => [ // первый уровень
                ['label' => 'Отчёты', 'url' =>['/reports/index']], // второй уровень
                ['label' => 'Карточки (артикулы)', 'url' => ['/reports/artlist']],
                ['label' => 'Корзина статистика', 'url' => ['/reports/cartdetail']],
                ['label' => 'Меню', 'url' => ['/site/index']],
            ],'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Пользователи', 'url' => ['/users/index'],'visible' => !Yii::$app->user->isGuest],
             !Yii::$app->user->isGuest ?
            ['label' => Yii::$app->user->identity->username, 'items' => [ // первый уровень
                ['label' => 'Личный кабинет', 'url' =>['/profile/index']], // второй уровень
                ['label' => 'Настройка себестоимости', 'url' => ['/']],
                ['label' => 'Мои API ключи', 'url' => ['/profile/mykeys']],
                ['label' => 'Активировать аккаунт', 'url' => ['/']],
                ['label' => 'Выход', 'url' => ['/site/logout']],
            ],'visible' => !Yii::$app->user->isGuest] :
//            Yii::$app->user->isGuest
//                ? ['label' => 'Вход', 'url' => ['/site/login']]
//                : '<li class="nav-item">'
//                    . Html::beginForm(['/site/logout'])
//                    . Html::submitButton(
//                        'Выход (' . Yii::$app->user->identity->username . ')',
//                        ['class' => 'nav-link btn btn-link logout']
//                    )
//                    . Html::endForm()
//                    . '</li>',
            ['label' => 'Вход', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Регистрация', 'url' => ['/site/signup'], 'visible' => Yii::$app->user->isGuest]
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
