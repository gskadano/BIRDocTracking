<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Companyagency;

/**
 * CompanyagencySearch represents the model behind the search form about `common\models\Companyagency`.
 */
class CompanyagencySearch extends Companyagency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['companyAgencyCode', 'companyAgencyName', 'companyAgencyDesc', 'companyAgencyCreate', 'companyAgencyUpdate'], 'safe'],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Companyagency::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'companyAgencyCreate' => $this->companyAgencyCreate,
            'companyAgencyUpdate' => $this->companyAgencyUpdate,
        ]);

        $query->andFilterWhere(['like', 'companyAgencyCode', $this->companyAgencyCode])
            ->andFilterWhere(['like', 'companyAgencyName', $this->companyAgencyName])
            ->andFilterWhere(['like', 'companyAgencyDesc', $this->companyAgencyDesc]);

        return $dataProvider;
    }
}
