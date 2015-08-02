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
            [['id', 'document_id', 'user_receive', 'docStatus_id', 'user_release'], 'integer'],
            [['docWorkflowComment', 'timeAccepted', 'timeRelease', 'totalTimeSpent'], 'safe'],
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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'document_id' => $this->document_id,
            'user_receive' => $this->user_receive,
            'docStatus_id' => $this->docStatus_id,
            'timeAccepted' => $this->timeAccepted,
            'timeRelease' => $this->timeRelease,
            'user_release' => $this->user_release,
        ]);

        $query->andFilterWhere(['like', 'docWorkflowComment', $this->docWorkflowComment])
            ->andFilterWhere(['like', 'totalTimeSpent', $this->totalTimeSpent]);

        return $dataProvider;
    }
}
