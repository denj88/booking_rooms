<?php

use app\models\Room;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Номера';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [

            'category.name',

            'category.rooms_count',

	        [
				'format' => 'raw',
		        'value' => function (Room $room) use ($searchModel) {
			        return Html::a(
							'Забронировать',
							Url::to(['/booking-room/create/'.$room->id, 'dateFrom' => $searchModel->dateFrom, 'dateTo' => $searchModel->dateTo]),
							['class' => 'btn btn-secondary', 'target' => '_blank']
			        );
		        },
	        ],
        ],
    ]); ?>

</div>
