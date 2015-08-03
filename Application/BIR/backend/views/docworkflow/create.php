<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Docworkflow */

$this->title = 'Create Docworkflow';
$this->params['breadcrumbs'][] = ['label' => 'Docworkflows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docworkflow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
