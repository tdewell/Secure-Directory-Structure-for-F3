<?php



$f3=require('../lib/base.php');


/* seed data DTD*/
require('../app/data/seed.php');
//echo $seed_data;

foreach ($seed_data as $entry) {
   	//echo $entry;
}

$f3->set('seed_data', $seed_data);
/* END DTD */

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('../app/config.ini');

$f3->route('GET /',
	function($f3) {
		$classes=array(
			'Base'=>
				array(
					'hash',
					'json',
					'session'
				),
			'Cache'=>
				array(
					'apc',
					'memcache',
					'wincache',
					'xcache'
				),
			'DB\SQL'=>
				array(
					'pdo',
					'pdo_dblib',
					'pdo_mssql',
					'pdo_mysql',
					'pdo_odbc',
					'pdo_pgsql',
					'pdo_sqlite',
					'pdo_sqlsrv'
				),
			'DB\Jig'=>
				array('json'),
			'DB\Mongo'=>
				array(
					'json',
					'mongo'
				),
			'Auth'=>
				array('ldap','pdo'),
			'Bcrypt'=>
				array(
					'mcrypt',
					'openssl'
				),
			'Image'=>
				array('gd'),
			'Lexicon'=>
				array('iconv'),
			'SMTP'=>
				array('openssl'),
			'Web'=>
				array('curl','openssl','simplexml'),
			'Web\Geo'=>
				array('geoip','json'),
			'Web\OpenID'=>
				array('json','simplexml'),
			'Web\Pingback'=>
				array('dom','xmlrpc')
		);
		$f3->set('classes',$classes);
		$f3->set('content_header','../app/views/secure_directory.htm');
		$f3->set('content','../app/views/welcome.htm');
		echo View::instance()->render('../app/views/layout.htm');
	}
);

$f3->route('GET /userref',
	function($f3) {
		$f3->set('content','../app/views/userref.htm');
		echo View::instance()->render('../app/views/layout.htm');
	}
);

$f3->run();
