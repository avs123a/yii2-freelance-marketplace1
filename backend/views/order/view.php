<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны, что желаете удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'type',
            'title',
            'category',
            'description',
            'skills',
            'currency',
            'price',
            'dateA',
            'dateB',
            'worker_login',
            'status',
        ],
    ]) ?>
	
	
	
	<
	<?= GridView::widget([
        'dataProvider' => $bidsDataProvider,
        'filterModel' => $bidSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'currency',
            'price',
            'term',
            // 'comment',
            'status',

            [
			    'class' => 'yii\grid\ActionColumn',
				'controller' => 'bid',
				'template' => '{delete}',
			],
        ],
    ]); ?>

</div>
