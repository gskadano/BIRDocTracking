<?php

namespace frontend\controllers;

use Yii;
use common\models\Document;
use common\models\DocumentSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use common\models\Pendingdoc;
use common\models\Section;

use common\models\Docworkflow;

/**
 * DocumentController implements the CRUD actions for Document model.
 */

class DocumentController extends Controller
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 
    public function actionCreate()
    {
       $model = new Document();
       
	   if ($model->load(Yii::$app->request->post())) 
	   {
	        //$model->file = UploadedFile::getInstance($model, 'documentImage');
			$model->file = UploadedFile::getInstance($model, 'file');
            $save_file='';
			
			
            if($model->file)
	        {
               $imagepath = 'uploads/images/'; // Create folder under web/uploads/logo
               $model->documentImage = $imagepath .rand(10,100).'-'.$model->file->name;
               $save_file=1;
			}
			
			$userid = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
			
			$model->user_id = $userid;
	   
	        if ($model->save()) 
	        {
			   //if ($model->documentImage)
			   //{
			     //  $model->file->saveAs($model->documentImage);
			   //}
			
			   if($save_file)
			   {
                 $model->file->saveAs($model->documentImage);
               }
			
			return $this->redirect(['view', 'id' => $model->id]);
            } 
	   }
	   
	   else 
	   {
            return $this->renderAjax('create', ['model' => $model]);
       }
    }
	
    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->documentUpdate = date('Y-m-d H:i:s',strtotime("+6 hours"));
        
		if ($model->load(Yii::$app->request->post())) 
		{
            $model->file = UploadedFile::getInstance($model, 'file');
            $save_file='';
			
			if($model->file)
		    {
               $imagepath = 'uploads/images/';
               $model->documentImage = $imagepath .rand(10,100).'-'.$model->file->name;
               $save_file = 1;
            }
	
	     	if ($model->save())
		    {
        
		       if($save_file)
		       {
                  $model->file->saveAs($model->documentImage);
                  //return $this->redirect(['view', 'id' => $model->id]);
			   }
        
	     	return $this->redirect(['view', 'id' => $model->id]);
            } 
     
	    }
		
		else 
		{
            return $this->render('update', ['model' => $model]);
        }
    }
	
	public function actionConfirm($id){
		
		$model = $this->findModel($id);
		
		$userid = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
		$sectionid = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'section_id');
		$userFName = ArrayHelper::getValue(User::find()->where(['id' => $userid])->one(), 'userFName');
		$userLName = ArrayHelper::getValue(User::find()->where(['id' => $userid])->one(), 'userLName');
		$section = ArrayHelper::getValue(Section::find()->where(['id' => $sectionid])->one(), 'sectionName');
		$documentname = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'documentName');
		
		$model->user_id = $userid;
		//$pendid = 2;
		
		/*
		$model->load(Yii::$app->request->post());		
		$model->save();
		*/
		
		$pendingid = ArrayHelper::getValue(Pendingdoc::find()->where(['and', ['pendingDocSection'=>$section], ['pendingDocName'=>$documentname], ['pendingDocFName'=>$userLName . ', ' . $userFName]])->one(), 'id');
		
		$this->findModelPending($pendingid)->delete();
		
		//Pendingdoc::find()->where(['and', ['pendingDocSection'=>$section], ['pendingDocName'=>$documentname], ['pendingDocFName'=>$userLName . ', ' . $userFName]])->one();
		
		//if(Pendingdoc()->pendingDocSection == $section && Pendingdoc()->pendingDocName == $documentname && Pendingdoc()->pendingDocFName == $userLName . ', ' . $userFName){
			//Pendingdoc::findOne($pendid)->delete();
			
		//}
		$document = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'id');
		if ($model->save()) {
			$workflow = new Docworkflow();
			
			$workflow->document_id = $document;
			$workflow->user_receive = $userid;
			$workflow->docStatus_id = 1;
			//$workflow->timeAccepted = date('Y-m-d H:i:s');
			print_r('level1');
			print_r($documentname); print_r($userid);
			if($workflow->save()){
				print_r('level2');
				return $this->redirect(['index']);
			}
			
        }
		
	}
	
	public function actionRelease($id)
	{
		$model = $this->findModel($id);
		
		$workflowid = ArrayHelper::getValue(Docworkflow::find()->where(['document_id' => $id])->orderBy(['id'=>SORT_DESC])->one(), 'id');
		//print_r($workflowid . ' level0 ' . $model->user_id);
		
		if ($model->load(Yii::$app->request->post())) {
		//$userid1 = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
		$sectionid = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'section_id');
		$userFName = ArrayHelper::getValue(User::find()->where(['id' => $model->user_id])->one(), 'userFName');
		$userLName = ArrayHelper::getValue(User::find()->where(['id' => $model->user_id])->one(), 'userLName');
		$section = ArrayHelper::getValue(Section::find()->where(['id' => $sectionid])->one(), 'sectionName');
		$documentname = ArrayHelper::getValue(Document::find()->where(['id' => $id])->one(), 'documentName');
			$pendingdoc = new Pendingdoc();
			$pendingdoc->pendingDocFName = $userLName . ', ' . $userFName;
			$pendingdoc->pendingDocSection = $section;
			$pendingdoc->pendingDocName = $documentname;
			
			
			if($workflowid == null){
				if($pendingdoc->save()){
					print_r('level3');
					return $this->redirect(['index']);
					//return $this->redirect('index.php?r=pendingdoc');
				}
			}else{
				$workflow1 = new Docworkflow();			
				$workflow1 = $this->findModelWorkflow($workflowid);
				
				//$workflow1->id = $workflowid;
				$workflow1->timeRelease = date('Y-m-d H:i:s');
				//$workflow1->totalTimeSpent = date('Y-m-d H:i:s');
				$workflow1->user_release = $model->user_id;
				print_r('level1');
				if($workflow1->save()){
					print_r('level2');
					if($pendingdoc->save()){
						print_r('level3');
						return $this->redirect(['index']);
						//return $this->redirect('index.php?r=pendingdoc');
					}
				}
			}
		}
			else {
			return $this->renderAjax('release', [
                'model' => $model,
			]);
			}
	}
	
    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 
	 public function actionDeleteimg($id, $field)
    {
        
        $img = $this->findModel($id)->$field;
        if($img)
		{
            if (!unlink($img)) 
			{
            return false;
            }
        }
    
        $img = $this->findModel($id);
        $img->$field = NULL;
        $img->update();
    
        return $this->redirect(['update', 'id' => $id]);
    }
	 
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findModelPending($id)
	{
		if (($model = Pendingdoc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
	}
	protected function findModelWorkflow($workflowid)
    {
		
        if (($workflow1 = Docworkflow::findOne($workflowid)) !== null) {
            return $workflow1;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}