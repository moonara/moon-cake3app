<?php
return [
	'Datasources' => [
		
		'default' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Sqlite',
			'persistent' => false,
			'username' => '',
			'password' => '',
			'database' => ROOT . DS . 'db' . DS . 'mydata2.sqlite3',
			'encoding' => 'utf8',
			'cacheMetadata' => true,
		],
	],

];
