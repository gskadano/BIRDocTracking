<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Docstatus */

$this->title = 'Create Docstatus';
$this->params['breadcrumbs'][] = ['label' => 'Docstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
