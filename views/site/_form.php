<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */


$this->title = $model->isNewRecord ? 'Добавить промокод' : 'Редактировать промокод';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <?php

            echo Nav::widget([
                'options' => ['class' => 'nav nav-sidebar'],
                'items' => [

                ],
            ]);

            ?>

        </div>
        <div class="col-lg-10">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= ($model->isNewRecord || $status) ? $form->field($model, 'name')->textInput()
                : $form->field($model, 'name')->textInput(['disabled' => 'true']) ?>
            <?= ($model->isNewRecord || $status) ? $form->field($model, 'tar_zone')->dropDownList([
                    'Новосибирск',
                    'Санкт-Петербург',
                    'Казань',
                    'Кемерово',
                    'Москва'
                ]) : $form->field($model, 'tar_zone')->dropDownList([
                    'Новосибирск',
                    'Санкт-Петербург',
                    'Казань',
                    'Кемерово',
                    'Москва'
                ], ['disabled' => 'true']); ?>
            <?= ($model->isNewRecord || $status) ?  $form->field($model, 'reward')->textInput() :
                $form->field($model, 'reward')->textInput(['disabled' => 'true']) ?>
            <?= ($model->isNewRecord || $status) ? $form->field($model, 'begin_data')->widget(DatePicker::classname(),
                ['pluginOptions' => [
                    'disabled' => true,
                ],]) :
                $form->field($model, 'begin_data')->widget(DatePicker::classname()) ?>
            <?= $form->field($model, 'end_data')->widget(DatePicker::classname()) ?>
            <?= $model->isNewRecord ? '' : $form->field($model, 'status')->dropDownList([
                '0' => 'Неактивный',
                '1' => 'Активный',
            ]);
            ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
