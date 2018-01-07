<?php
use yii\helpers\Html;

$this->title = 'Сообщения';
?>
<style>
  .col-md-10{background-color:#ffffff; }
  .col-md-2{background-color:#33cccc; }
  .msg{background-color:#009999; }
  p{color:#ffff00; }
</style>
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
<h2>Входящие сообщения</h2>

	<!-- received messages -->
  <?php foreach($recvmsg as $rcm): ?>
    <div class="row msg">
	  <p>ID <?= $rcm['id'] ?></p>
	  <p><?= $rcm['surname'] ?> <?= $rcm['name'] ?> (<?= $rcm['username'] ?>)</p>
	  <p>Тема : <?= $rcm['subject'] ?></p>
	  <div class="col-md-10">
	     <?= $rcm['text'] ?>
	  </div>
	  <div class="col-md-2">
	    <?= Html::a('',['cabinet/delete-message', 'msg_id' => $rcm['id'] ],['data-method'=>'post', 'class' => 'fa fa-trash']) ?>
      </div>
	</div>
  <?php endforeach; ?><br><br>
 
  <h2>Отправленные сообщения</h2>
	<!-- sent messages -->
  <?php foreach($sent as $scm): ?>
    <div class="row msg">
	  <p>ID <?= $rcm['id'] ?></p>
	  <p><?= $rcm['surname'] ?> <?= $rcm['name'] ?> (<?= $rcm['username'] ?>)</p>
	  <p>Тема : <?= $rcm['subject'] ?></p>
	  <div class="col-md-10">
	     <?= $rcm['text'] ?>
	  </div>
	  <div class="col-md-2">
	    <?= Html::a('',['cabinet/delete-message','id' => $rcm['id'] ],['data-method'=>'post', 'class' => 'fa fa-trash']) ?>
      </div>
	</div>
  <?php endforeach; ?>