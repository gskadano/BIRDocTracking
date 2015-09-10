<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Docworkflow;

/**
 * DocworkflowSearch represents the model behind the search form about `common\models\Docworkflow`.
 */
class DocworkflowSearch extends Docworkflow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', ], 'integer'],
            [['docWorkflowComment', 'docStatus_id', 'user_release', 'user_receive', 'document_id', 'timeAccepted', 'timeRelease', 'totalTimeSpent'], 'safe'],
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
        $query = Docworkflow::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->joinWith('document')->joinWith([
    'userReceive' => function ($q) {
        $q->from('user receive');
    },
])->joinWith('docStatus')->joinWith([
    'userRelease' => function ($q) {
        $q->from('user release');
    },
]);

		//$query->joinWith('document')->joinWith('userRelease')->joinWith('userReceive');
		
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'id' => $this->id,
            //'document_id' => $this->document_id,
            //'user_receive' => $this->user_receive,
            //'docStatus_id' => $this->docStatus_id,
            'timeAccepted' => $this->timeAccepted,
            'timeRelease' => $this->timeRelease,
            //'user_release' => $this->user_release,
        ]);

        $query->andFilterWhere(['like', 'docWorkflowComment', $this->docWorkflowComment])
            ->andFilterWhere(['like', 'totalTimeSpent', $this->totalTimeSpent])
			->andFilterWhere(['like', 'document.documentName', $this->document_id])
			->andFilterWhere(['like', 'receive.userLName', $this->user_receive])
			->andFilterWhere(['like', 'docstatus.docStatusName', $this->docStatus_id])
			->andFilterWhere(['like', 'docworkflow.id', $this->id])
			->andFilterWhere(['like', 'release.userLName', $this->user_release]);

        return $dataProvider;
    }
}
