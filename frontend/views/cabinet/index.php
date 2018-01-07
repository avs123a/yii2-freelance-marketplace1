<?php
use yii\helpers\Html;

$this->title = 'Personal cabinet';
?>
<style>
 
</style>
<div id="profile1">
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    Логин:
  </div>
  <div class="col-xs-3" style="border:1px">
    Email:
  </div>
 </div>
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    <?= $user->username ?>
  </div>
  <div class="col-xs-3" style="border:1px">
    <?= $user->email ?>
  </div>
 </div>
</div>

<div class="row">
 <nav class="navbar-default" >
  <ul class="nav navbar-nav cabinet-menu">
    <li><strong><?= Html::a('Кабинет',['cabinet/index'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мой профиль',['cabinet/profile-view', 'id' => \Yii::$app->user->getId()],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мои заказы',['cabinet/orders'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('Мои отклики на заказы',['cabinet/bids'],['class' => 'btn cabinet-menu']) ?></strong></li>
	<li><strong><?= Html::a('сообщения',['cabinet/messages'],['class' => 'btn cabinet-menu']) ?></strong></li>
  </ul>
 </nav>
</div>
<h2>Здраствуйте, <?= \Yii::$app->user->identity->username ?></h3><br>
<div id="stats1">
 <h3>Краткая статистика</h3>
 <div class="row">
  <div class="col-xs-3" style="border:1px">
    Мои заказы:&nbsp;<strong><?= $orders ?></strong>
  </div>
  <div class="col-xs-3" style="border:1px">
    Мои отклики на чужие заказы:&nbsp;<strong><?= $bids ?></strong>
  </div>
</div>
</div>
<script>
  $(document).ready(function(){
	  alert("Это ваш личный кабинет.Здесь вы можете смотреть и редактировать профиль,свои заказы,отклики на чужие заказы");
  });
</script>
