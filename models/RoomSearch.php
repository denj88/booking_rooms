<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * RoomSearch represents the model behind the search form of `app\models\Room`.
 */
class RoomSearch extends Room
{
	public $dateFrom;
	public $dateTo;

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['category_id'], 'integer'],
			[['dateFrom', 'dateTo'], 'date', 'format' => 'php:Y-m-d'],
			['dateTo', 'validateDateTo', 'skipOnEmpty' => false, 'skipOnError' => false],
		];
	}

	/**
	 * @param $attribute
	 * @param $params
	 * @return void
	 */
	public function validateDateTo($attribute, $params)
	{
		if (empty($this->dateFrom) && empty($this->dateTo)) return;

		if (empty($this->dateFrom) || empty($this->dateTo))
			$this->addError($attribute, 'Необходимо заполнить обе даты');

		if (strtotime($this->dateFrom) > strtotime($this->dateTo))
			$this->addError($attribute, 'Дата начала бронирования должна быть ранее, чем дата окончания бронирования');
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return ArrayHelper::merge(parent::attributeLabels(), [
			'dateRange' => 'Даты бронирования',
		]);
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Room::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}


		// grid filtering conditions
		$query->andFilterWhere([
			Room::tableName() . '.category_id' => $this->category_id,
		]);

		if (!empty($this->dateFrom) && !empty($this->dateTo)) {
			$query->joinWith('bookingRooms');

			$query->andWhere([
				"AND",
				[
					'OR',
					['not between', BookingRoom::tableName() . '.date_from', $this->dateFrom, $this->dateTo],
					['IS', BookingRoom::tableName() . '.date_from', null]
				],
				[
					'OR',
					['not between', BookingRoom::tableName() . '.date_to', $this->dateFrom, $this->dateTo],
					['IS', BookingRoom::tableName() . '.date_to', null]
				]
			]);
		}

		return $dataProvider;
	}
}
