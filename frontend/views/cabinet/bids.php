<?php
use yii\helpers\Html;

$this->title = 'Заявки';
?>
<style>
  th{border:1px solid black !important; background-color:#339999; color:#ffff00;}
  td{border:1px solid black !important; background-color:#ffffff;}
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
<h2>Заявки к заказам</h2>
<div>
 <table class="col-xs-8">
    <tr>
	  <th>ID заказа</th>
	  <th>Валюта</th>
	  <th>Оплата</th>
	  <th>Срок</th>
	  <th>Статус</th>
	  <th></th>
	</tr>
  <?php foreach($model as $bid): ?>
    <tr>
	  <td><?= $bid['order_id'] ?></td>
	  <td><?= $bid['currency'] ?></td>
	  <td><?= $bid['price'] ?></td>
	  <td><?= $bid['term'] ?></td>
	  <td><?= $bid['status'] ?></td>
	  <td>
	    <?= Html::a('',['order/view','id' => $bid['order_id']],['class' => 'fa fa-eye']) ?>
      </td>
	</tr>
  <?php endforeach; ?>
 </table>
</div>