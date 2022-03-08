<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'category_id')
	    ->dropDownList(\app\models\Category::getCategoryNames(), ['prompt'=>'Выберите категорию...'])
	    ->label('Категория') ?>


	<div>Даты бронирования</div>
	<?php
	echo DatePicker::widget([
		'model' => $model,
		'attribute' => 'dateFrom',
		'attribute2' => 'dateTo',
		'options' => ['placeholder' => 'Начало'],
		'options2' => ['placeholder' => 'Конец'],
		'type' => DatePicker::TYPE_RANGE,
		'form' => $form,
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'autoclose' => true,
		],

	]);

	?>

	<br>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
