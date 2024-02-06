<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use yii\grid\GridView;
$this->title = 'Детальная статистика корзины:';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //Pjax::begin([
//        // Опции Pjax
//    ]);?>
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($cartForm, 'articul')->input('integer')->label('Артикул') ?>
    <?= $form->field($cartForm, 'date_from')->input('date')->label('Дата с') ?>
    <?= $form->field($cartForm, 'date_to')->input('date')->label('Дата по') ?>
<!--    --><?php //= $form->field($cartForm, 'aggregationLevel')->dropDownList(['day' => 'День',
//        'week' => 'Неделя',
//        'month'=>'Месяц'], ['prompt' => 'Выберите тип выборки...'])->label('Тип') ?>
<!--    --><?php //= $form->field($model, 'date_to')->textarea() ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success', 'name' => 'get-detail-cart--button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
<!--    --><?php //Pjax::end();?>
</div>
<div>
<!--    135635827-->
    <?php
        if (!empty($wbCartDetail)){
            ?>
    <h1>Результат запроса:</h1>
    <?php
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [                      // the owner name of the model
                        'label' => 'Артикул',
                        'value' => $wbCartDetail ? $wbCartDetail['articule'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Название',
                        'value' => $wbCartDetail ? $wbCartDetail['name'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Дата',
                        'value' => $wbCartDetail ? $wbCartDetail['date'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Количество переходов в карточку товара:',
                        'value' => $wbCartDetail ? $wbCartDetail['openCardCount'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Положили в корзину, штук',
                        'value' => $wbCartDetail ? $wbCartDetail['addToCartCount'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Заказали товаров, шт',
                        'value' => $wbCartDetail ? $wbCartDetail['ordersCount'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Заказали на сумму, руб',
                        'value' => $wbCartDetail ? $wbCartDetail['ordersSumRub'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Выкупили товаров, шт',
                        'value' => $wbCartDetail ? $wbCartDetail['buyoutsCount'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Выкупили на сумму, руб',
                        'value' =>$wbCartDetail ? $wbCartDetail['buyoutsSumRub'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Процент выкупа, %',
                        'value' => $wbCartDetail ? $wbCartDetail['buyoutPercent'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Конверсия в корзину, %',
                        'value' => $wbCartDetail ? $wbCartDetail['addToCartConversion'] : null,
                    ],
                    [                      // the owner name of the model
                        'label' => 'Конверсия в заказ, %',
                        'value' => $wbCartDetail ? $wbCartDetail['cartToOrderConversion'] : null,
                    ],
                ],
            ]);
        }
    ?>
</div>





