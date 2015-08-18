<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserAdmin;
use common\models\position;
use common\models\section;

/**
 * UserSearch represents the model behind the search form about `backend\models\UserAdmin`.
 */
class UserSearch extends UserAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['userFName', 'userMName', 'userLName', 'username', 'password_hash', 'auth_key', 'email', 'created_at', 'updated_at', 'position_id', 'section_id'], 'safe'],
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
        $query = UserAdmin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*$query->andFilterWhere([
            'id' => $this->id,
            'position_id'['position'],
			'section_id'['section'],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);*/
		
		$query->joinWith('position')
		    ->joinWith('section');

        $query->andFilterWhere(['like', 'userFName', $this->userFName])
            ->andFilterWhere(['like', 'userMName', $this->userMName])
            ->andFilterWhere(['like', 'userLName', $this->userLName])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'position.positionName', $this->position_id])
			->andFilterWhere(['like', 'section.sectionName', $this->section_id]);

        return $dataProvider;
    }
}
