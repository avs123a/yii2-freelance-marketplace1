<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bid', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'user_id',
            'currency',
            'price',
            // 'term',
            // 'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
