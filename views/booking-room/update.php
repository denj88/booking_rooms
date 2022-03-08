<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRoom */

$this->title = 'Изменить параметры бронирования номера: ' . $model->room->category->name;
$this->params['breadcrumbs'][] = ['label' => 'Номера', 'url' => ['/']];
$this->params['breadcrumbs'][] = ['label' => $model->room->category->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить параметры бронирования';
?>
<div class="booking-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
