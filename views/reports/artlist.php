<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\BaseListView;
use yii\bootstrap5\BootstrapIconAsset;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;

BootstrapIconAsset::register($this);
?>
<h1>Список карточек:</h1>
<div>
    <h2 style="font-size: 18px;">Запросить у WB обновление: <a href="<?= yii\helpers\Url::to(['reports/wbarticles']) ?>" class="bi bi-arrow-clockwise bold"></a></h2>
<!--    --><?php //Pjax::begin(['id' => 'countries']) ?>
    <?php

   echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'nilai_tugas',
                'value' => function ($dataProvider)
                {
                    return $dataProvider->nilai_tugas;
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Name',
                        'size'=>'md',
                        'formOptions'=>['action' => ['krs-detail/editNilai']],
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                    ];
                }
            ],
            ['class' => SerialColumn::class],
            [
                'label'=>'Фото',
                'value'=> function($dataProvider){
                    if($dataProvider['photo']){
                        return Html::img($dataProvider['photo'], ['alt' => 'Фото','style'=>'width: 150;height: 100px;']);
                    }else {
                        return 'Нет';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label'=>'Артикул',
                'value'=>'articule'
            ],
            [
                'label'=>'Название',
                'value'=>'name'
            ],
            [
                'label'=>'Создан',
                'value'=>'created'
            ],
            [
                'label'=>'Последнее обновление',
                'value'=>'updated'
            ],
            [
                'label'=>'Себестоимость',
                'format'=>'raw',
                'value' => function($dataProvider){
                    return $dataProvider['cost_price'] ? $dataProvider['cost_price'] : 'Не указана';
                }
            ],
            [
                'label'=>'',
                'format'=>'raw',
                'value' => function($dataProvider)
                {
                    return Html::a('', ['/reports/edit'], ['class' => 'bi bi-pen mr-auto']);
                }
            ],
        ],
    ])
    ?>
<!--    --><?php //Pjax::end() ?>
</div>
