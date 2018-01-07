<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'type',
            'title',
            'category',
            // 'description',
            // 'skills',
            // 'currency',
            // 'price',
            // 'dateA',
            // 'dateB',
            // 'worker_login',
            // 'status',

            [
			    'class' => 'yii\grid\ActionColumn',
				'template' => '{view}, {delete}',
			],
        ],
    ]); ?>
</div>
