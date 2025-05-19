<?php 

//defined('ROOTPATH') OR exit('Access Denied!');

define('IS_DOMAIN_DEPLOYED',false);


if($_SERVER['SERVER_NAME'] == 'new-arcadia-back.test')
{
	/** localhost database config **/
	define('ROOT', 'http://naw-arcadia-back.test/');
	define('DBNAME', 'new-arcadia-db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBPORT', '');
	define('DBCHARSET', '');

}
elseif (IS_DOMAIN_DEPLOYED)
{
	/** online server database config **/
	define('ROOT', $_ENV['DEPLOYED_WEBSITE_URL']);
	define('DBNAME', $_ENV['DATABASE_NAME']);
	define('DBHOST', $_ENV['DATABASE_HOST']);
	define('DBUSER', $_ENV['DATABASE_USERNAME']);
	define('DBPASS', $_ENV['DATABASE_PASSWORD']);
	define('DBPORT', $_ENV['DATABASE_PORT']);
	define('DBCHARSET', $_ENV['DATABASE_CHARSET']);
}

define('LOCALHOST_URL', 'http://new-arcadia-back.test');

// define('DATABASE_MONGODB_URI', $_ENV['DATABASE_MONGODB_URI']);

define('APP_NAME', "New Arcadia");
define('APP_DESC', "Site de Zoo");

define('DEBUG', true);