<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
	'modules' => [],	
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		$Url = Url::base(),
		'urlManagerBackend' => [
			'class' => 'yii\web\urlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			//'baseUrl' => 'http://localhost/birproj/backend/web/index.php',
			//'baseurl' => 'http://localhost\..\birproj/backend/web/index.php',
			'baseUrl' => $Url+'/index.php',
		],
    ],
    'params' => $params,
];