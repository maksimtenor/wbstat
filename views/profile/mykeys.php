<?php
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\widgets\DetailView;
?>
<h1>API ключи:</h1>

<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [                      // the owner name of the model
            'label' => 'Wildberries',
            'format' => 'html',
            'value' => $model->api_key ? Html::tag('span', Html::encode('Активен'), ['style' => ['color' => 'green']]) : Html::tag('span', Html::encode('Не задан'), ['style' => ['color' => 'red']]),
        ],
        [                      // the owner name of the model
            'label' => 'Ozon',
            'format' => 'html',
            'value' => Html::tag('span', Html::encode('Временно недоступно'), ['style' => ['color' => 'red']]),
        ],
    ]
]);
?>

