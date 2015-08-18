<?php

namespace backend\controllers;

use Yii;
use common\models\Pendingdoc;
use common\models\PendingdocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Document;

/**
 * PendingdocController implements the CRUD actions for Pendingdoc model.
 */
class PendingdocController extends Controller
{
    public function behaviors()
    {
        return [
			'access'=>[
				'class'=>AccessControl::classname(),
				'only'=>['create','update','index'],
				'rules'=>[
					[
						'allow'=>true,
						'roles'=>['@']
					],
				]
			],
			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pendingdoc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PendingdocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pendingdoc model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pendingdoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pendingdoc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pendingdoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pendingdoc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionRelease($id)
	{
		//$model = $this->findModel($id);
		$model = new Pendingdoc();
		
		$userid = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'user_id');
		
		$userFName = ArrayHelper::getValue(User::find()->where(['id' => $userid])->one(), 'userFName');
		$userLName = ArrayHelper::getValue(User::find()->where(['id' => $userid])->one(), 'userLName');
		$section = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'section_id');
		$documentname = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'documentName');
		
		if ($model->load(Yii::$app->request->post())) {
			$model->pendingDocFName = $userFName . $userLName;
			$model->pendingDocSection = $section;
			$model->pendingDocName = $documentname;
			
			if($model->save()){
				return $this->redirect(['document/index']);
			}
		}
			else {
			return $this->renderAjax('release', [
                'model' => $model,
			]);
			}
	}

    /**
     * Finds the Pendingdoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pendingdoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pendingdoc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
