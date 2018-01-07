<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Редактирование профиля';
?>
<?php $form = ActiveForm::begin(); ?>
<h2>Редактирование профиля</h2>
<hr>
<div class="row">
   <h3>&nbsp;&nbsp;Персональные данные</h3>
  <div class="col-xs-6">
     <?= $form->field($model,'surname') ?>
  </div>
  <div class="col-xs-6">
     <?= $form->field($model,'name') ?>
  </div>
</div>
<hr>
<div class="row">
  <h3>&nbsp;&nbsp;Местонахождение</h3>
  <div class="col-xs-6">
     <?= $form->field($model,'country') ?>
	 <?= $form->field($model,'city') ?>
  </div>
</div>
<hr>
 <h3>Контактные данные</h3>
  <?= $form->field($model,'phone') ?>
  <?= $form->field($model,'skype') ?>
  <?= $form->field($model,'vk') ?>
  <?= $form->field($model,'fb') ?>
  <div class="form-group">
     <?= Html::SubmitButton('Сохранить',['style'=>'background-color:#009999','class' =>'btn btn-success']) ?>
  </div>
<?php ActiveForm::end(); ?>