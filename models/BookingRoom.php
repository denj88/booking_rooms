<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_room".
 *
 * @property int $id
 * @property int $room_id ID номера
 * @property string $date_from Дата бронирования от
 * @property string $date_to Дата бронирования до
 * @property string $email E-mail
 * @property string $name Имя
 *
 * @property Room $room
 */
class BookingRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'date_from', 'date_to', 'email', 'name'], 'required'],
            [['room_id'], 'integer'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
            ['date_to', function($attribute, $params) {
	            if (strtotime($this->date_from) > strtotime($this->date_to))
		            $this->addError($attribute, 'Дата начала бронирования должна быть ранее, чем дата окончания бронирования');

            }],

            [['date_from', 'date_to'], function($attribute, $params) {

				$exists = static::find()
					->andFilterWhere(['NOT IN', BookingRoom::tableName() . '.id', $this->id])
					->andWhere([BookingRoom::tableName() . '.room_id' => $this->room_id])
					->andWhere([
						"AND",
						['between', BookingRoom::tableName() . '.date_from', $this->date_from, $this->date_to],
						['between', BookingRoom::tableName() . '.date_to', $this->date_from, $this->date_to],
					])->exists();

	            if ($exists)
		            $this->addError($attribute, 'К сожалению, данные даты бронирования заняты.');

            }],
            [['email', 'name'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'ID номера',
            'date_from' => 'Дата бронирования от',
            'date_to' => 'Дата бронирования до',
            'email' => 'E-mail',
            'name' => 'Имя',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\RoomQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BookingRoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BookingRoomQuery(get_called_class());
    }
}
