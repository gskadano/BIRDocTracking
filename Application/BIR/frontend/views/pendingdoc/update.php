<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pendingdoc */

$this->title = 'Update Pendingdoc: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pendingdocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendingdoc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
