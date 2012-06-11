#!/usr/bin/php5 -q

<?php
define('JOOSH_TARGET_DIR', $argv[1]);

define('_JEXEC', 1);
define('JPATH_BASE', JOOSH_TARGET_DIR . "/installation");
define('DS', DIRECTORY_SEPARATOR);

define('JPATH_ROOT',			JOOSH_TARGET_DIR);
define('JPATH_SITE',			JPATH_ROOT);
define('JPATH_CONFIGURATION',	JPATH_ROOT);
define('JPATH_ADMINISTRATOR',	JPATH_ROOT . '/administrator');
define('JPATH_LIBRARIES',		JPATH_ROOT . '/libraries');
define('JPATH_PLUGINS',			JPATH_ROOT . '/plugins');
define('JPATH_INSTALLATION',	JPATH_ROOT . '/installation');
define('JPATH_THEMES',			JPATH_BASE);
define('JPATH_CACHE',			JPATH_ROOT . '/cache');
define('JPATH_MANIFESTS',		JPATH_ADMINISTRATOR . '/manifests');

require_once(JPATH_LIBRARIES . "/joomla/import.php");

jimport('joomla.database.table');
jimport('joomla.environment.uri');
jimport('joomla.utilities.utility');
jimport('joomla.utilities.arrayhelper');

// Change directory to Joomla's installation directory.
chdir(JPATH_INSTALLATION);

//jimport("joomla.installer.installer");

require_once(JOOSH_TARGET_DIR . "/installation/helpers/database.php");
require_once(JOOSH_TARGET_DIR . "/installation/models/database.php");
require_once(JOOSH_TARGET_DIR . "/installation/models/configuration.php");

$installHelper = new JInstallationHelperDatabase();
$dbo = $installHelper;

$databaseModel = new JInstallationModelDatabase(array("dbo"=>$dbo));
$configModel = new JInstallationModelConfiguration(array("dbo"=>$dbo));

$options = array(
	"site_offline" => false,
	"site_name" => "Joomla Site",
	"site_metadesc" => "",
	"site_metakeys" => "",
	"db_type" => "mysql",
	"db_host" => "localhost",
	"db_user" => "root",
	"db_pass" => "root",
	"db_name" => "joomla",
	"db_prefix" => "jom_",
	"ftp_host" => "localhost",
	"ftp_port" => "21",
	"ftp_save" => true,
	"ftp_user" => "admin",
	"ftp_pass" => "admin",
	"ftp_root" => "/",
	"ftp_enable" => false,
	"ftpEnable" => false,
	"admin_password" => "admin",
	"admin_user" => "admin",
	"admin_email" => "admin@admin.com"
);

$app = JFactory::getApplication('installation');

$databaseModel->initialise($options);
$configModel->setup($options);