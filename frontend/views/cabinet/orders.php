<?php
use yii\helpers\Html;

$this->title = 'My Orders ';
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
<h2>Мои Заказы</h2><?= Html::a('Создать заказ',['order/create'],['class' => 'btn btn-success']) ?><br><br>
<div>
 <table class="col-xs-12">
    <tr>
	  <th>ID</th>
	  <th>Тип</th>
	  <th class="col-xs-6">Название</th>
	  <th class="col-xs-1">Дата создания</th>
	  <th class="col-xs-1">Дата окончания</th>
	  <th class="col-xs-1">Оплата</th>
	  <th>Статус</th>
	  <th></th>
	</tr>
  <?php foreach($model as $order): ?>
    <tr>
	  <td><?= $order['id'] ?></td>
	  <td><?= $order['type'] ?></td>
	  <td class="col-xs-6"><?= $order['title'] ?></td>
	  <td class="col-xs-1"><?= $order['dateA'] ?></td>
	  <td class="col-xs-1"><?= $order['dateB'] ?></td>
	  <td class="col-xs-1"><?= $order['price'] ?></td>
	  <td><?= $order['status'] ?></td>
	  <td>
	    <?= Html::a('',['order/view','id' => $order['id']],['class' => 'fa fa-eye']) ?>
	  </td>
	</tr>
  <?php $total_cost = 0;endforeach; ?>
 </table>
</div>