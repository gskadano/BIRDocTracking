<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
/*
$role = Yii::$app->user->identity->position_id;
if($role == 2){
	return Yii::$app->getResponse()->redirect('/backend/web/index.php?r=document');
}else{ */
?>
<?php $this->beginPage()  ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => "Bureau of Internal Revenue's Document Workflow Tracking System",
				//'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                   'class' => 'navbar-inverse navbar-fixed-top',
               ],
            ]);
			
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
				$roles = Yii::$app->user->identity->position_id;

				if($roles == 2 || $roles == 8){
					
					$menuItems = [
						//['label' => 'Home', 'url' => ['/site/index']],
						//['label' => 'About', 'url' => ['/site/about']],
						//['label' => 'Contact', 'url' => ['/site/contact']],
					];
					//return Yii::$app->getResponse()->redirect('/birproj/backend/web/index.php?r=document');
					//return $this->redirect('/birproj/backend/web/index.php?r=document');
				}else{
					$menuItems = [
						['label' => 'Home', 'url' => ['/site/index']],
						['label' => 'About', 'url' => ['/site/about']],
					];
					
					$menuItems[]=['label' => 'Document',
					   'visible' => !Yii::$app->user->isGuest,
						'items' => [
							['label' => 'My Document', 'url' => ['/document']],
							['label' => 'Document Workflow', 'url' => ['/docworkflow']],
							['label' => 'Pending Document', 'url' => ['/pendingdoc']],
						],
					];
					//return Yii::$app->getResponse()->redirect('index.php?r=document');
				}
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>


        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; BIR <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php /*}*/ $this->endPage() ?>
