<?php

namespace backend\controllers;

use Yii;
use backend\models\UserAdmin;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for UserAdmin model.
 */
class UserController extends Controller
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
     * Lists all UserAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserAdmin model.
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
     * Creates a new UserAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new UserAdmin();
		
        if ($model->load(Yii::$app->request->post())) {
			$model->position_id = $model->position_id;
			$model->section_id = $model->section_id;
			$model->userFName = $model->userFName;
			$model->userMName = $model->userMName;
			$model->userLName = $model->userLName;
            $model->username = $model->username;
            $model->email = $model->email;
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }*/
	
	public function actionCreate()
    {
        //$model = new SignupForm();
		$model = new UserAdmin();
        if ($model->load(Yii::$app->request->post())) {
			print_r('level1');
            if ($user = $model->signup()) {
				print_r('level1');
                if (Yii::$app->getUser()) {
                    //return $this->goHome();
					return $this->redirect(['view', 'id' => $user->id]);
                }
            }
        }
		
		return $this->render('create', [
                'model' => $model,
            ]);
    }
	
    /**
     * Updates an existing UserAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			$model->setPassword($model->password_hash);
            $model->generateAuthKey();
			$model->updated_at = date('Y-m-d H:i:s');
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
