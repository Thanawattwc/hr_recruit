<?php
date_default_timezone_set('Asia/Bangkok');
//$_SERVER['CI_ENV'] == 'development';//
define('_APPLICATION_NAME_', 'Purchase Order System');
define('_APPLICATION_LOGO_', 'images/logo.png');
define('_APPLICATION_FAVICON_', 'images/favicon.png');
define('_APPLICATION_PROTOCOL_', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://');
define('_APPLICATION_MULTI_LANGUAGE_', FALSE); // TRUE | FALSE
define('_APPLICATION_LANGUAGE_', 'th'); // th | en
define('_APPLICATION_MAIN_PAGE_', 'main'); // First start Controller

define('_OAUTH_', TRUE);
define('_ALL_EMPLOYEE_USAGE_', FALSE);
define('_LIMIT_LEVEL_USAGE_', FALSE); // >10 | >=10 | <10 | <=10 | =10 | FALSE

define('_PASSWORD_STRENGTH_', FALSE);

define('_EMAIL_FROM_ADDRESS_', '');
define('_EMAIL_FROM_NAME_', _APPLICATION_NAME_);

if ($_SERVER['CI_ENV'] == 'production')
{
  define('_APPLICATION_DOMAIN_', 'appname.mitrphol.com');

	define('_DATABASE_HOST_', '127.0.0.1');
	define('_DATABASE_USERNAME_', 'USERNAME');
	define('_DATABASE_PASSWORD_', 'PASSWORD');
	define('_DATABASE_NAME_', 'mitrphol_APPNAME_db');
	define('_DATABASE_DRIVER_', 'mysqli');

  define('_SMTP_AGENT_', '');
  define('_SMTP_HOST_', '');
  define('_SMTP_PORT_','' );
  define('_SMTP_USERNAME_', '');
  define('_SMTP_PASSWORD_', '');
  define('_API_MITRPHOL_URL_', '');
  define('_API_MITRPHOL_CLIENT_', '');
  define('_API_MITRPHOL_SECRET_', '');
}

if ($_SERVER['CI_ENV'] == 'testing')
{
  //  define('_APPLICATION_DOMAIN_', 'localhost:8080/pur');
  define('_APPLICATION_DOMAIN_', '');

  define('_DATABASE_HOST_', '');
  define('_DATABASE_USERNAME_', '');
  define('_DATABASE_PASSWORD_', '');
  define('_DATABASE_NAME_', '');
  define('_DATABASE_DRIVER_', '');

  define('_SMTP_AGENT_', '');
  define('_SMTP_HOST_', '');
  define('_SMTP_PORT_','' );
  define('_SMTP_USERNAME_', '');
  define('_SMTP_PASSWORD_', '');

  define('_API_MITRPHOL_URL_', '');
  define('_API_MITRPHOL_CLIENT_', '');
  define('_API_MITRPHOL_SECRET_', '');
}

if ($_SERVER['CI_ENV'] == 'development')
{
  define('_APPLICATION_DOMAIN_', '');

  define('_DATABASE_HOST_', '');
  define('_DATABASE_USERNAME_', '');
  define('_DATABASE_PASSWORD_', '');
  define('_DATABASE_NAME_', '');
  define('_DATABASE_DRIVER_', '');

  define('_SMTP_AGENT_', '');
  define('_SMTP_HOST_', '');
  define('_SMTP_PORT_','' );
  define('_SMTP_USERNAME_', '');
  define('_SMTP_PASSWORD_', '');

  define('_API_MITRPHOL_URL_', '');
  define('_API_MITRPHOL_CLIENT_', '');
  define('_API_MITRPHOL_SECRET_', '');
}

define('_REFRESH_TOKEN_LIFE_', (((60 * 60) * 24) * 3));