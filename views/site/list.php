<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\Url;
?>

<div class="col-sm-12 col-md-12 main">
    <h1 class="page-header">Промокоды</h1>
    <?php  //var_dump($articles); exit; ?>
    <?= GridView::widget([
        'dataProvider' => $codes,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'tar_zone',
                'format' => 'raw',

                'value' => function ($model) {
                    return $model::tar_zones[$model->tar_zone];
                },
            ],
            'reward',
            [
                'attribute' => 'begin_data',
                'format' => ['time', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'end_data',
                'format' => ['time', 'php:Y-m-d'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',

                'value' => function ($model) {
                    return $model::status[$model->status];
                },
            ],


            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} ',
                'buttons' =>
                    [

                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['update','id' => $model->id]), [
                                'title' => Yii::t('yii', 'Редактировать'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },

                    ]
            ]
        ],
    ]); ?>
</div>