<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
$user = common\models\User::findOne(['username' => Yii::$app->user->identity->username]);
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user->id])->label(false) ?>
	
   <div class="row">
    <div class="col-xs-4">
    <?= $form->field($model, 'type')->dropDownList($items=array('1 Проект'=>'1 Проект','Временное сотрудничество'=>'Временное сотрудничество','Постоянная удаленная работа'=>'Постоянная удаленная работа'))->label("Тип работы") ?>
    </div>
	<div class="col-xs-4">
	<?= $form->field($model, 'category')->dropDownList($items=array('Верстка'=>'Верстка','Web-программирование'=>'Web-программирование','Интернет-магазины'=>'Интернет-магазины','Сайты под ключ'=>'Сайты под ключ','CMS'=>'CMS','Тестирование сайтов'=>'Тестирование сайтов','Программирование'=>'Программирование','Мобильное ПО'=>'Мобильное ПО','Тестирование ПО'=>'Тестирование ПО','Системное программирование'=>'Системное программирование','Базы данных'=>'Базы данных','Дизайн сайтов'=>'Дизайн сайтов','Разработка игр'=>'Разработка игр'))->label("Категория") ?>
	</div>
   </div>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label("Название") ?>


    <?= $form->field($model, 'description')->textArea(['maxlength' => true])->label("Описание") ?>

    <?= $form->field($model, 'skills')->textInput(['maxlength' => true])->label("Навыки") ?>
	
  <div class="row">
    <div class="col-xs-4">
    <?= $form->field($model, 'currency')->dropDownList($items=array('USD' => 'USD', 'EUR' => 'EUR', 'UAH' => 'UAH', 'RUB' => 'RUB'))->label("Валюта") ?>
    </div>
    <div class="col-xs-4">	
    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label("Оплата") ?>
	</div>
  </div>
    <?//= $form->field($model, 'method')->textInput(['maxlength' => true])->label("Способ") ?>

    <?= $form->field($model, 'dateA')->hiddenInput(['value' => "".date('d')."/".date('m')."/".date('y')])->label(false) ?>

    <?= $form->field($model, 'dateB')->textInput(['maxlength' => true])->label("Дата завершения (ДД/ММ/ГГГГ)") ?>

    <?//= $form->field($model, 'worker_login')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
