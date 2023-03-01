<?php

namespace app\models;

use yii\base\Model;
use yii;
use yii\data\ActiveDataProvider;
use app\models\Material;

/**
 * MaterialSearch represents the model behind the search form of `app\models\Material`.
 */
class MaterialSearch extends Material
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inventoryNumber', 'status', 'materialCategoryId'], 'integer'],
            [['model', 'serialNumber'], 'safe'],
        ];
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Material::find();

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
            'inventoryNumber' => $this->inventoryNumber,
            'status' => $this->status,
            'materialCategoryId' => $this->materialCategoryId,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'serialNumber', $this->serialNumber])
            ->andFilterWhere(['like', 'materialCategory.name', $this->materialCategory]);

        return $dataProvider;
    }
}