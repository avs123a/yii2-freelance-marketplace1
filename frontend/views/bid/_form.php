<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Bid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bid-form">
   <?php
   $userid = \Yii::$app->user->identity->getId();
    if($model->isNewRecord)
	 {
		 $action = Url::to(['//bid/create']);
	 }
	 else
	 {
		 $action = Url::to(['//bid/update', 'id' => $model->id]);
	 } ?>
    <?php $form = ActiveForm::begin([
	    'action' => $action,
	]); ?>

    <?= $form->field($model, 'order_id')->hiddenInput(['value' => $order_id])->label(false) ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $userid])->label(false) ?>

    <?= $form->field($model, 'currency')->dropDownList(['USD' => 'USD', 'EUR' => 'EUR', 'UAH' => 'UAH', 'RUB' => 'RUB']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term')->textInput() ?>

    <?= $form->field($model, 'comment')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
