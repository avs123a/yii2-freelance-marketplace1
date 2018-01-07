<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#controlblock{margin:25px;text-align:center; }
h1{margin:0;background-color:#339999;color:#ffffcc; }
#descwork{margin:0;padding:0;background-color:#ffffff;font-size:16px; }
#skillstxt{margin:0;background-color:#33cccc; }
#remarks{margin:0;background-color:#ffff99; }
#reviews{background-color:#99cccc;color:#000000;}
.biddesc{background-color:#ffff00;}
.btn.fa.fa-thumbs-up{background-color:#33cccc;color:#ffffff;}
.btn.fa.fa-thumbs-down{background-color:#ff6633;color:#ffffff;}
</style>
<div class="order-view">
  <div class="row equal">
    <div class="col-xs-5">
	    <h2>Заказчик: (<?=$customer->username ?>) <?php if($customer->username != \Yii::$app->user->identity->username) echo "<button type='button' id='msgbtn' class='fa fa-envelope' ></button>"; ?></h2>
		<h3><?=$customer->surname ?>&nbsp;<?=$customer->name ?></h3>
		<p><strong><?=$customer->city ?>(<?=$customer->country ?>)</strong></p>
		<div class="col-xs-6">
		    <p>Почта: <?=$customer->email ?></p>
		    <p>тел. :<?=$customer->phone ?></p>
		</div>
		<div class="col-xs-6">
		    <p>Skype: <?=$customer->skype ?></p>
		    <p>Vkontakte: <?=$customer->vk ?></p>
		    <p>Facebook: <?=$customer->fb ?></p>
		</div>
    </div>
	<div class="col-xs-7" id="controlblock">
	    <?php if($editable): ?>
	    <h3>Управление заказом</h3>
		<p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны что хотите удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
		<p class="btn btn-default" id="newpay">+Способ оплаты</p>
        </p>
		<div id="add_pay" hidden>
		    <?= Html::beginForm(['order/view', 'id' => $model->id],'post') ?>
			<select name="method_pay">
			    <option value="vs">Visa</option>
				<option value="mc">Master Card</option>
				<option value="crs">Cirrus</option>
				<option value="mstr">Maestro</option>
				<option value="p24">Приват24</option>
				<option value="advc">AdvCash</option>
				<option value="wm">Webmoney</option>
			    <option value="pp">PayPal</option>
				<option value="pz">Payza</option>
				<option value="prmn">Perfect Money</option>
				<option value="pb">Payeer</option>
				<option value="pnr">Payoneer</option>
				<option value="qw">Qiwi</option>
				<option value="btc">Bitcoin</option>
				<option value="ltc">Litecoin</option>
				<option value="doge">Dogecoin</option>
				<option value="dash">Darkcoin(DASH)</option>
				<option value="eth">Ethereum</option>
				<option value="ik">Интеркасса</option>
				<option value="rbks">RoboKassa</option>
				<option value="ydm">Яндекс деньги</option>
			</select>
			<input type="submit" name="addmethod" value="Добавить"/>
			<input type="submit" name="resetmethod" class="btn-warning" value="Очистить способы оплаты"/>
			<?= Html::endForm(); ?>
		</div>
		<script>
		    $("#newpay").click(function(){
				$("#add_pay").show();
				$("#newpay").hide();
			});
		</script>
		<? endif; ?>
    </div>
  </div>
  <div class="row">
       <h1><?= Html::encode($this->title) ?></h1>
  </div>
  <div class="row equal" style="padding:0;">
    <div class="col-xs-9" id="descwork">
        <p><?= $model->description ?></p>
		<p><strong>Навыки: <?= $model->skills ?></strong></p>
		<p>Способы оплаты:</p>
		<?php foreach($methods as $method){
			switch($method['title'])
			{
				case "vs":echo "<image width=70 height=40 src='http://www.livetradingnews.com/wp-content/uploads/2017/01/Visa-701x432.gif' alt='Visa'></image>"; break;
				case "mc":echo "<image width=70 height=40 src='https://www.geek.com/wp-content/uploads/2012/05/Screen-Shot-2012-05-08-at-2.55.35-PM.png' alt='Master Card'></image>"; break;
				case "crs":echo "<image width=70 height=40 src='http://www.ecashatms.com/slides/cirrus%20logo.jpg' alt='Cirrus'></image>"; break;
				case "p24":echo "<image width=70 height=40 src='https://staleks.ua/sites/default/files/1333107620_03-privat24-logo1.png' alt='Приват24'></image>"; break;
				case "advc":echo "<image width=70 height=40 src='http://dataworld.info/wp-content/uploads/2016/12/advcash-russia-koshelek-300x175.png' alt='AdvCash'></image>"; break;
				case "wm":echo "<image width=70 height=40 src='http://tezgsm.com/img2/icons/payment/webmoney.png' alt='Webmoney'></image>"; break;
				case "pp":echo "<image width=70 height=40 src='http://2e8ram2s1li74atce18qz5y1-wpengine.netdna-ssl.com/wp-content/uploads/2011/09/paypal-logo.jpg' alt='PayPal'></image>"; break;
				case "pb":echo "<image width=70 height=40 src='https://payeer.com/bitrix/templates/difiz/img/quote-logo.png' alt='Payeer'></image>"; break;
				case "qw":echo "<image width=70 height=40 src='http://www.americanbankingnews.com/logos/qiwi-plc-logo.jpg' alt='Qiwi'></image>"; break;
				case "btc":echo "<image width=70 height=40 src='https://bitcoin.org/img/icons/opengraph.png' alt='Bitcoin'></image>"; break;
				case "mstr":echo "<image width=70 height=40 src='https://upload.wikimedia.org/wikipedia/en/thumb/f/fd/Maestro_logo.svg/1280px-Maestro_logo.svg.png' alt='Maestro'></image>"; break;
				case "ik":echo "<image width=70 height=40 src='http://excash24.com/wp-content/uploads/interkassa-600x201.jpg' alt='Интеркасса'></image>"; break;
				case "rbks":echo "<image width=70 height=40 src='http://logodownload.ru/img/robokassa-logo-download.jpg' alt='Robokassa'></image>"; break;
				case "ydm":echo "<image width=70 height=40 src='http://feofan.net/wp-content/uploads/2014/12/yad.jpg' alt='Яндекс деньги'></image>"; break;
				case "pz":echo "<image width=70 height=40 src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFEShJYMuYLxuoXWJNSdZF3NhXLUFWj7FVIsJncRWdxQQyUK2v' alt='Payza'></image>"; break;
				case "pnr":echo "<image width=70 height=40 src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGmTkNk2m_7J_uJGkZxy1S1L616w0ZQPgkhPZsAuRIQHgIRSlA' alt='Payoneer'></image>"; break;
				case "prmn":echo "<image width=70 height=40 src='http://kinvestor.ru/wp-content/uploads/2015/04/perfect-money-obzor-otzyv.png' alt='Perfect Money'></image>"; break;
				case "ltc":echo "<image width=70 height=40 src='http://files.coinmarketcap.com.s3-website-us-east-1.amazonaws.com/static/img/coins/200x200/litecoin.png' alt='Litecoin'></image>"; break;
				case "doge":echo "<image width=70 height=40 src='https://mining-cryptocurrency.ru/wp-content/uploads/Dogecoin.jpg' alt='Dogecoin'></image>"; break;
				case "dash":echo "<image width=70 height=40 src='http://i.imgur.com/jaDBOYK.png' alt='Dash'></image>"; break;
				case "eth":echo "<image width=70 height=40 src='http://cryptoage.com/images/mining/ether-faucet-new/faucet.jpg' alt='Ethereum'></image>"; break;
			}
		}?>
	</div>
	<div class="col-xs-3" id="remarks">
	    <p>Создан: <?= $model->dateA ?></p>
		<p>Актуальный до: <?= $model->dateB ?></p>
		<p>Оплата: <?= $model->price ?> <?= $model->currency ?></p>
	    <p>Исполнитель: <?= $model->worker_login ?></p>
		<p>Статус: <?= $model->status ?></p>
	</div>
  </div>
</div>
<br><br>
<h1 id="reviews">Заявки фрилансеров к заказу</h1><br>

<?php if(!$editable): ?>
<?php
Modal::begin([
   'header' => '<h3>Новая заявка</h3>',
   'toggleButton' => ['label' => 'Откликнуться на заказ', 'tag' => 'button', 'class' => 'btn btn-success'],
]);
?>
<?= $this->render('//bid/_form', ['model' => new \common\models\Bid(), 'order_id' => $model->id]) ?>
<?php Modal::end(); ?>
<?php else: ?>
  <h3>Вы не можете откликаться на свои заказы</h3>
<?php endif; ?>
<br>
<?php if($bids==null){ echo "<h3>Нет заявок к заказу!</h3>";}else{
foreach($bids as $bid): ?>
<div class="row equal" style="border:1px solid black;margin:0;padding:0">
    <div class="col-xs-8" style="background-color:#ffffff;margin:0;padding:0">
	    <h3 style="background-color:#99cccc;margin:0;padding:0"><?=$bid['surname'] ?>&nbsp;<?=$bid['name'] ?>&nbsp(<?=$bid['username'] ?>) <?=Html::a('см. профиль',['cabinet/profile-view', 'id' => $bid['userid']]) ?></h3>
		<div class="col-xs-12"><?=$bid['comment'] ?></div>
		<?php if(\Yii::$app->user->identity->username == $bid['username']): ?>
		<?php
        Modal::begin([
            'header' => '<h3>Редактирования заявки</h3>',
            'toggleButton' => ['label' => 'Редактировать Заявку', 'tag' => 'button', 'class' => 'btn', 'style' => 'background-color:#00cc99; color:#ffffff'],
        ]);
        ?>
        <?= $this->render('//bid/_form', ['model' => \common\models\Bid::findOne($bid['id']), 'order_id' => $model->id]) ?>
        <?php Modal::end(); ?>
		<?= Html::a('Удалить заявку',['bid/delete', 'id' => $bid['id']],['data-method'=>'post', 'class' => 'btn', 'style' => 'background-color:#ff0000; color:#ffffff']) ?>
		<?php endif; ?>
	</div>
	<div class="col-xs-2 biddesc">
	    <?php 
				        if($bid['currency']=='USD')echo "<p>".$bid['price']." $</p>";
				        if($bid['currency']=='EUR')echo "<p>".$bid['price']." &euro;</p>";
						if($bid['currency']=='UAH')echo "<p>".$bid['price']." &#8372;</p>";
						if($bid['currency']=='RUB')echo "<p>".$bid['price']." RUB</p>";
	    ?>
		<p class="col-xs-10"><?=$bid['term'] ?>&nbsp;дней</p>
		<p class="col-xs-10"><?=$bid['status'] ?></p>
	</div>
	<div class="col-xs-2">
	    <?php if($editable): ?>
		<?= Html::beginForm(['order/view', 'id' => $model->id],'post') ?>
		   <input name="bid_id" type="hidden" value="<?=$bid['id'] ?>" />
		   <input name="wlogin" type="hidden" value="<?=$bid['username'] ?>" />
		   <input type="submit" name="choose" class="col-xs-12 btn fa fa-thumbs-up" value="Выбрать">
		   <input type="submit" name="ignore" class="col-xs-12 btn fa fa-thumbs-down" value="Отклонить">
		<?= Html::endForm(); ?>
		<?php endif; ?>
	</div>
</div>
<br>
<?php endforeach;} ?>

<div class="modal fade" id="wrmsg">
   <div class="modal-dialog">
        <div class="modal-content">
		     <div class="modal-header" style="background-color:#336666; color:#ffffff">
			    Новое сообщение
			 </div>
			 <?=Html::beginForm(['//order/send-message', 'rec_id' => $customer->id], 'post') ?>
			 <div class="modal-body">
				<input type="text" name="subject" size=75 placeholder="Тема сообщения: <?=$model->title ?>"><br>
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
    $("#msgbtn").click(function(){
		$("#wrmsg").modal('show');
	});
</script>

