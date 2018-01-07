<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Мой профиль';
?>
<style>
  ul{list-style:none; }
  #mailbtn{ background-color:#33cccc; }
</style>


<div class="container">
<?php if(\Yii::$app->user->identity->username == $model->username): ?>
<div class="row">
 <nav class="navbar-default" >
  <ul class="nav navbar-nav" style="background-color:#ccffff">
    <li><strong><?= Html::a('Кабинет',['cabinet/index'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мой профиль',['cabinet/profile-view', 'id' => \Yii::$app->user->getId()],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мои заказы',['cabinet/orders'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мои отклики на заказы',['cabinet/bids'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('сообщения',['cabinet/messages'],['class' => 'btn cabinet-menu']) ?></strong></li>
  </ul>
 </nav>
</div>
<?php endif; ?>
<h2> Профиль пользователя <?=$model->username ?> <?php if($model->username != \Yii::$app->user->identity->username) echo "<button type='button' id='msgbtn1' class='fa fa-envelope' ></button>"; ?></h2>
<div class="row">
<div class="col-xs-8">
   <hr>
   <?php if($model->surname == null): ?>
    <div class="row">
	 <h2>Ваш профиль не заполненный</h2>
	 <h3>Заполните,пожалуйста,профиль для дальнейшей работы с сервисом</h3>
	 <?= Html::a('Заполнить профиль',['cabinet/profile-update'], ['class' => 'col-xs-3 btn btn-success', 'style' => 'background-color:#00ffcc']) ?>
    </div>
	<?php else: ?>
	<h3>Персональные данные</h3>
	<div class="row">
      <div class="col-xs-6">
	    <ul>
            <li>Фамилия:</li>
            <li>Имя:</li>
		</ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->surname ?></li>
            <li><?=$model->name ?></li>
		</ul>
	  </div>
	</div>
	<hr>
	<h3>Место нахождения</h3>
	<div class="row">
	  <div class="col-xs-6">
		<ul>
            <li>Страна:</li>
            <li>Город:</li>
		</ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->country ?></li>
            <li><?=$model->city ?></li>
		</ul>
	  </div>
	</div>
	<hr>
	<h3>Контактные данные</h3>
	<div class="row">
	  <div class="col-xs-6">
		<ul>
            <li>тел.:</li>
            <li>Email:</li>
			<li>Skype:</li>
            <li>Vk:</li>
			<li>FB:</li>
        </ul>
	  </div>
	  <div class="col-xs-6">
	    <ul>
            <li><?=$model->phone ?></li>
            <li><?=$model->email ?></li>
			<li><?=$model->skype ?></li>
            <li><?=$model->vk ?></li>
			<li><?=$model->fb ?></li>
        </ul>
	  </div>
	</div>
	<?php endif; ?>
  </div>
</div>
</div>
<?php if(\Yii::$app->user->identity->username == $model->username): ?>
<?php if($model->surname != null): ?>
<div class="form-group">
   <?= Html::a('Редактировать профиль',['cabinet/profile-update'],['class' => 'btn btn-default', 'style' => 'background-color:#00ffcc']) ?>
   <button class="btn" id="mailbtn">Сменить Email</button>
</div>
<?php endif; ?>
<div class="col-xs-6" id="new_mail" hidden="hidden">
<?= Html::beginForm(['cabinet/profile-view'],'post') ?>
  <label>New email address:</label>
  <input type="text" name="email_new">
  <?= Html::SubmitButton('Сохранить',['style'=>'background-color:#006633','class' =>'btn btn-success']) ?>
  <button type="button" id="mail_cancel" class="btn btn-danger">Cancel</button>
<?= Html::endForm(); ?>
</div>
<?php endif; ?>

<div class="modal fade" id="wrmsg1">
   <div class="modal-dialog">
        <div class="modal-content">
		     <div class="modal-header" style="background-color:#336666; color:#ffffff">
			    Новое сообщение
			 </div>
			 <?=Html::beginForm(['//order/send-message', 'rec_id' => $model->id], 'post') ?>
			 <div class="modal-body">
			    <input type="hidden" name="senderID" value="<?=\Yii::$app->user->getId() ?>">
				
				<input type="hidden" name="receiverID" value="<?=$customer->id ?>">
				<input type="text" name="subject" size=75 placeholder="Тема сообщения"><br>
				<textarea name="msgtext" cols=77 rows=4>Текст сообщения</textarea>
			 </div>
			 <div class="modal-footer">
			    <input type="submit" name="send_msg" class="btn btn-success" value="Отправить">
			 </div>
			 <?=Html::endForm(); ?>
		</div>
   </div>
</div>
<script>
    $("#msgbtn1").click(function(){
		$("#wrmsg1").modal('show');
	});
</script>

<script>
  $(document).ready(function(){
	  alert("Вы перешли на страницу просмотра профиля");
	  $("#mailbtn").click(function(){
		  $("#new_mail").show();
	  });
	  $("#mail_cancel").click(function(){
		  $("#new_mail").hide();
	  });
	  
  });
</script>