<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRoom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'room_id')->hiddenInput()->label(false) ?>

	<?= $form->field($model, 'date_from')->widget(DatePicker::class, [
		'options' => ['placeholder' => 'Дата начала бронирования'],
		'type' => DatePicker::TYPE_INPUT,
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'autoclose' => true
		]
	]); ?>

	<?= $form->field($model, 'date_to')->widget(DatePicker::class, [
		'options' => ['placeholder' => 'Дата окончания бронирования'],
		'type' => DatePicker::TYPE_INPUT,
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'autoclose' => true
		]
	]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Забронировать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
