<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tableseq */

$this->title = 'Create Tableseq';
$this->params['breadcrumbs'][] = ['label' => 'Tableseqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tableseq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
