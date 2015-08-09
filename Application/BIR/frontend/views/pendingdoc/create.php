<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pendingdoc */

$this->title = 'Create Pending Document';
$this->params['breadcrumbs'][] = ['label' => 'Pending Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendingdoc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
