<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'PMD.UA ADMIN';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Админпанель</h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Пользователей</h2>

                <p><?=$users ?></p>
            </div>
            <div class="col-lg-3">
                <h2>Заказов</h2>

                <p><?=$orders ?></p>
            </div>
            <div class="col-lg-3">
                <h2>Заявок к заказам</h2>

                <p><?=$bids ?></p>
            </div>
			<div class="col-lg-3">
                <h2>Сообщений</h2>

                <p><?=$msg ?></p>

            </div>
        </div>

    </div>
</div>
