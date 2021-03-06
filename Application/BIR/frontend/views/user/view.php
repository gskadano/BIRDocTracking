<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use frontend\models\UserAdmin;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->FullName;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'position_id',
            //'position_id',
			//'section_id',
            array('label'=>'Position', 'value'=>$model->position->positionName),
            array('label'=>'Section', 'value'=>$model->section->sectionName),
			
			'userFName',
            'userMName',
            'userLName',
            'username',
            'password_hash',
            'auth_key',
            'status',
            'email:email',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
