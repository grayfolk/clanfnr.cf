<?php
$params = require (__DIR__ . '/params.php');

$config = [ 
		'id' => 'clanfnr.cf',
		'basePath' => dirname ( __DIR__ ),
		'bootstrap' => [ 
				'log' 
		],
		'language' => 'ru-RU',
		'defaultRoute' => 'home',
		'components' => [ 
				'authClientCollection' => $params ['authClientCollection'],
				'request' => [ 
						// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
						'cookieValidationKey' => 'C6IeDNEzfgk9KQiq21GRFlcPQAIhjTGt8bvJQjWoXN2Y75gze9QuCQwKZVPsInEPTQPv2y4BKir0FpMVLO23kjeIBX4z8nvWopij' 
				],
				'cache' => [ 
						'class' => 'yii\caching\FileCache' 
				],
				'errorHandler' => [ 
						'errorAction' => 'home/error' 
				],
				'mailer' => [ 
						'class' => 'yii\swiftmailer\Mailer',
						// send all mails to a file by default. You have to set
						// 'useFileTransport' to false and configure a transport
						// for the mailer to send real emails.
						'useFileTransport' => true 
				],
				'log' => [ 
						'traceLevel' => YII_DEBUG ? 3 : 0,
						'targets' => [ 
								[ 
										'class' => 'yii\log\FileTarget',
										'levels' => [ 
												'error',
												'warning' 
										] 
								] 
						] 
				],
				'db' => require (__DIR__ . '/db.php'),
				'urlManager' => [ 
						'enablePrettyUrl' => true,
						'showScriptName' => false,
						'rules' => [ 
								'/' => 'home/index',
								'<controller:(equipment|event|material|inviders)>' => '<controller>/index',
								'<action:(about|contact|captcha)>' => 'home/<action>',
								// Admin
								'admin/<controller:(equipment|material|accessory|accessory-type|location|location-type|material-type|level|expirience|event|event-type)>' => 'admin/<controller>/index' ,
								'admin/<controller:[\w-]+>/<action:(view|update|delete)>/<id:\d+>' => 'admin/<controller>/<action>',
								'admin/<controller:[\w-]+>/<action:(view|update|delete)>/<type_id:\d+>/<start:[\w-]+>/<coverage:[\w-]+>' => 'admin/<controller>/<action>',
								'admin/<controller:[\w-]+>/<action:[\w-]+>' => 'admin/<controller>/<action>'
						]
						 
				],
				'assetManager' => [ 
						'class' => 'yii\web\AssetManager',
						'linkAssets' => true,
						'converter' => [ 
								'class' => 'yii\web\AssetConverter',
								'commands' => [ 
										'less' => [ 
												'css',
												'lessc {from} {to} --no-color --source-map' 
										],
										'scss' => [ 
												'css',
												'@app/node_modules/.bin/node-sass {from} {to} --sourcemap' 
										],
										'sass' => [ 
												'css',
												'@app/node_modules/.bin/node-sass {from} {to} --sourcemap' 
										],
										'styl' => [ 
												'css',
												'stylus < {from} > {to}' 
										],
										'coffee' => [ 
												'js',
												'coffee -p {from} > {to}' 
										],
										'ts' => [ 
												'js',
												'tsc --out {to} {from}' 
										] 
								] 
						],
						'bundles' => [ 
								'yii\web\JqueryAsset' => [ 
										'js' => [ 
												YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js' 
										] 
								],
								'yii\jui\JuiAsset' => [ 
										'js' => [ 
												YII_ENV_DEV ? 'jquery-ui.js' : 'jquery-ui.min.js' 
										],
										'css' => [ 
												YII_ENV_DEV ? 'themes/smoothness/jquery-ui.css' : 'themes/smoothness/jquery-ui.min.css' 
										] 
								],
								'yii\bootstrap\BootstrapAsset' => [ 
										'css' => [ 
												YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css' 
										] 
								],
								'yii\bootstrap\BootstrapPluginAsset' => [ 
										'js' => [ 
												YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js' 
										] 
								] 
						] 
				] 
		],
		'modules' => [ 
				'user' => $params ['dektriumModule'] 
		],
		'params' => $params 
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config ['bootstrap'] [] = 'debug';
	$config ['modules'] ['debug'] = [ 
			'class' => 'yii\debug\Module',
			'allowedIPs' => $params ['giiAllowedIps'] 
	];
	
	$config ['bootstrap'] [] = 'gii';
	$config ['modules'] ['gii'] = [ 
			'class' => 'yii\gii\Module',
			'allowedIPs' => $params ['debugAllowedIps'] 
	];
}

return $config;
