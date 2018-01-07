<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'dateA') ?>

    <?php // echo $form->field($model, 'dateB') ?>

    <?php // echo $form->field($model, 'worker_login') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
