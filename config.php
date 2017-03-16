<?php
return [
	'id' => 'location',
	'class' => 'humhub\modules\places\Module',
	'namespace' => 'humhub\modules\places',
	'events' => [
		[
			'class' => \humhub\modules\user\models\Profile::className(),
			'event' => \humhub\modules\user\models\Profile::EVENT_AFTER_INSERT,
			'callback' => ['humhub\modules\places\controllers\DefaultController', 'storeResidence'],
		],

	],
];


