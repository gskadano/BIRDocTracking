<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
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
		'urlManagerFrontend' => [
			'class' => 'yii\web\urlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			//'baseUrl' => 'http://localhost/birproj/frontend/web/index.php',
			//'baseUrl' => 'http://localhost\..\frontend/web/index.php',
			'baseUrl' => 'birdoctrackingsample.16mb.com',
		],
    ],
    'params' => $params,
];
