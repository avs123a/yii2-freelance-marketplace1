<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>10 - Активный</h3>
	<h3>0 - Бан</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
