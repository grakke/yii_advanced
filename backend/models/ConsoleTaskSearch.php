<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConsoleTask;

/**
 * ConsoleTaskSearch represents the model behind the search form about `app\models\ConsoleTask`.
 */
class ConsoleTaskSearch extends ConsoleTask
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[
				[
					'id', 'created_at', 'updated_at', 'type', 'start_time', 'status', 'last_start_time',
					'last_finish_time'
				], 'integer'
			],
			[['name', 'program', 'created_by', 'updated_by', 'info'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param  array  $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = ConsoleTask::find();

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
			'id' => $this->id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'type' => $this->type,
			'start_time' => $this->start_time,
			'status' => $this->status,
			'last_start_time' => $this->last_start_time,
			'last_finish_time' => $this->last_finish_time,
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'program', $this->program])
			->andFilterWhere(['like', 'created_by', $this->created_by])
			->andFilterWhere(['like', 'updated_by', $this->updated_by])
			->andFilterWhere(['like', 'info', $this->info]);

		return $dataProvider;
	}
}
