<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $category_id ID категории
 *
 * @property BookingRoom[] $bookingRooms
 * @property Category $category
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'ID категории',
        ];
    }

    /**
     * Gets query for [[BookingRooms]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\BookingRoomQuery
     */
    public function getBookingRooms()
    {
        return $this->hasMany(BookingRoom::class, ['room_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RoomQuery(get_called_class());
    }
}
