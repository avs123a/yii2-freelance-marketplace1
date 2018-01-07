<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  h4{height:30px; background-color:#006666;}
  #btnwebdev{background-color:#006666; color:#ffffff;}
  #btnsoft{background-color:#006666; color:#ffffff;}
  #btnmobilesoft{background-color:#006666; color:#ffffff;}
  .tasks{background-color:#ffffff; padding:0; margin:0;}
  h4{margin:0;}
  div.taskid{margin:0;}
  .descrip{background-color:#669999;color:#ffff00;}
  .taskfooter{background-color:#99cccc; margin:0;}
  #searchbtn{background-color:#006666; color:#ffffff; }
  
  
</style>
<div class="order-index">

    <div class="row">
	    <div class="col-xs-3">
           <h1><?= Html::encode($this->title) ?></h1>
		   <h3><?=$selected_category ?></h3>
		</div>
		<?=Html::beginForm(['order/index'],'get'); ?>
		<div class="col-xs-6">
		    <input type="text" name="gsearch" class="col-xs-8"><input type="submit" id="searchbtn" value="Найти">
		</div>
		<?=Html::endForm(); ?>
	</div>
	
    <div class="row">
	    <div class="col-xs-3">
		   <?= Html::beginForm(['order/index'],'get'); ?>
		     <div class="col-xs-12 btn btn-default" id="btnwebdev">Разработка сайтов</div>
			 <div id="webdev" hidden>
		       <input type="submit" name="sd" class="col-xs-12 btn btn-default" value="Дизайн сайтов">
		       <input type="submit" name="wr" class="col-xs-12 btn btn-default" value="Верстка">
			   <input type="submit" name="wp" class="col-xs-12 btn btn-default" value="Web-программирование">
			   <input type="submit" name="imk" class="col-xs-12 btn btn-default" value="Интернет-магазины">
			   <input type="submit" name="sk" class="col-xs-12 btn btn-default" value="Сайты под ключ">
			   <input type="submit" name="cms" class="col-xs-12 btn btn-default" value="CMS">
			   <input type="submit" name="st" class="col-xs-12 btn btn-default" value="Тестирование сайтов">
			 </div>
			<div class="col-xs-12 btn btn-default" id="btnsoft">Прикладное ПО</div>
			<div id="soft" hidden>
			   <input type="submit" name="prog" class="col-xs-12 btn btn-default" value="Программирование">
		       <input type="submit" name="progsys" class="col-xs-12 btn btn-default" value="Системное программирование">
			   <input type="submit" name="databases" class="col-xs-12 btn btn-default" value="Базы данных">
			   <input type="submit" name="games" class="col-xs-12 btn btn-default" value="Разработка игр">
			   <input type="submit" name="testing" class="col-xs-12 btn btn-default" value="Тестирование ПО">
			</div>
			<input type="submit" name="mobilesoft" class="col-xs-12 btn btn-default" id="btnmobilesoft" value="Мобильное ПО"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		   <?=Html::endForm(); ?>
		   
		   <div class="tasks">
		   <?= Html::beginForm(['order/index'],'get'); ?>
		     <input type="radio" name="actuality" value="all_projects"  onchange="this.form.submit()"><label>Все проекты</label><br>
		     <input type="radio" name="actuality" value="active_projects" onchange="this.form.submit()"><label>Активные</label><br>
			 <input type="radio" name="actuality" value="closed_projects" onchange="this.form.submit()"><label>Завершенные</label>
		   <?=Html::endForm(); ?>
		   <p><strong>(<?=$search_status ?>)</strong></p>
		   </div>
	    </div>
	    <div class="col-xs-9">

		<?php
		   if($model==null){
			   echo "<h3>По данной категории нет заказов!</h3>";
		   }
		   else{
		?>
		    <?php foreach($model as $project): ?>
			  <h4><?=Html::a($project['title'],['order/view', 'id' => $project['id']],['style' => 'color:#ffffff']) ?></h4>
              <div class="row taskid equal">
			    <div class="col-xs-9 tasks">
				   
				   <p><strong>Требуемые навыки : <?=$project['skills'] ?></strong></p><br>
				   <p>Способы оплаты: </p>
				   <?php foreach($methods[$project['id']] as $method){
			         switch($method['title'])
			         {
				        case "vs":echo "<image width=70 height=40 src='http://www.livetradingnews.com/wp-content/uploads/2017/01/Visa-701x432.gif' alt='Visa'></image>"; break;
				        case "mc":echo "<image width=70 height=40 src='https://www.geek.com/wp-content/uploads/2012/05/Screen-Shot-2012-05-08-at-2.55.35-PM.png' alt='Master Card'></image>"; break;
				        case "crs":echo "<image width=70 height=40 src='http://www.ecashatms.com/slides/cirrus%20logo.jpg' alt='Cirrus' ></image>"; break;
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
				   <br>
				   <p class="taskfooter">Тип работы:<?=$project['type'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Категория:<?=$project['category'] ?></p>
				</div>
				<div class="col-xs-3 descrip">
				  <?php 
				        if($project['currency']=='USD')echo "<p>".$project['price']." $</p>";
				        if($project['currency']=='EUR')echo "<p>".$project['price']." &euro;</p>";
						if($project['currency']=='UAH')echo "<p>".$project['price']." &#8372;</p>";
						if($project['currency']=='RUB')echo "<p>".$project['price']." RUB</p>";
				  ?>
				   <p style="color:#ff6666;background-color:#330000"><strong>Актуальный до &nbsp;<?=$project['dateB'] ?></strong></p>
				</div>
			  </div>
			<?php endforeach; ?>
		<?php }?>
		<?=LinkPager::widget(['pagination' => $pagination]) ?>
	    </div>

	    <div class="col-xs-2">
	    </div>
	</div>
</div>


<script>
  $(document).ready(function(){
	  
	  $("#btnwebdev").click(function(){
		  $("#webdev").show();
		  $("#soft").hide();
	  });
	  $("#btnsoft").click(function(){
		  $("#soft").show();
		  $("#webdev").hide();
	  });
	  $("#btnmobilesoft").click(function(){
		  $("#webdev").hide();
		  $("#soft").hide();
	  });
  });
</script>
