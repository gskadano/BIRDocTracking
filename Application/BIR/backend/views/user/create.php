<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserAdmin */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'User Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
