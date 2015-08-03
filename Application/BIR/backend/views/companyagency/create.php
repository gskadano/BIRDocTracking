<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Companyagency */

$this->title = 'Create Companyagency';
$this->params['breadcrumbs'][] = ['label' => 'Companyagencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companyagency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
