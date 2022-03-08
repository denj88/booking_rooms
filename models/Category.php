<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name Название категории
 * @property int|null $rooms_count Кол-во комнат
 *
 * @property Room[] $rooms
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['rooms_count'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'rooms_count' => 'Кол-во комнат',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\RoomQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::class, ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CategoryQuery(get_called_class());
    }

	public static function getCategoryNames()
	{
		return ArrayHelper::map(static::find()->all(), 'id', 'name');
	}
}
