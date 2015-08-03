<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Agencycperson */

$this->title = 'Create Agencycperson';
$this->params['breadcrumbs'][] = ['label' => 'Agencycpeople', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agencycperson-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
