<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Agencycperson */

$this->title = 'Update Agency Contact Person: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Agency Contact Personnel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agencycperson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
