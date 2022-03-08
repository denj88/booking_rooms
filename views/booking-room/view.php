<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRoom */

$this->title = $model->room->category->name ;
$this->params['breadcrumbs'][] = ['label' => 'Номера', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-room-view">

    <h1><?= 'Параметры бронирования: ' . Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить параметры бронирования', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отменить бронирование', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите отменить бронь?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date_from',
            'date_to',
            'email:email',
            'name',
        ],
    ]) ?>

</div>
