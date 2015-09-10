<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pendingdoc;
use yii\helpers\ArrayHelper;

/**
 * PendingdocSearch represents the model behind the search form about `common\models\Pendingdoc`.
 */
class PendingdocSearch extends Pendingdoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['pendingDocFName', 'pendingDocSection', 'pendingDocName', 'pendingDocTimeRelease'], 'safe'],
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
        $query = Pendingdoc::find();
		
		$userlname = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'userLName');
		$userfname = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'userFName');
		
		$userfullname = $userlname . ', ' . $userfname;
		
		$query->where(['pendingDocFName' => $userfullname])->one();

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
            'pendingDocTimeRelease' => $this->pendingDocTimeRelease,
        ]);

        $query->andFilterWhere(['like', 'pendingDocFName', $this->pendingDocFName])
            ->andFilterWhere(['like', 'pendingDocSection', $this->pendingDocSection])
            ->andFilterWhere(['like', 'pendingDocName', $this->pendingDocName]);

        return $dataProvider;
    }
}
