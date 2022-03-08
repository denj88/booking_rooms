<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRoom */
/* @var $roomModel app\models\Room */

$this->title = 'Бронирование номера категории: '.$roomModel->category->name;
$this->params['breadcrumbs'][] = ['label' => 'Номера', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
