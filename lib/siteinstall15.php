#!/usr/bin/php5 -q

<?php
define('JOOSH_TARGET_DIR', $argv[1]);

define('_JEXEC', 1);
define('JPATH_BASE', JOOSH_TARGET_DIR . "/installation");
define('DS', DIRECTORY_SEPARATOR);

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'installer'.DS.'helper.php' );

// Change directory to Joomla's installation directory.
chdir(JOOSH_TARGET_DIR . "/installation");

// create the mainframe object
$mainframe =& JFactory::getApplication('installation');

require_once(JOOSH_TARGET_DIR . "/installation/installer/models/model.php");

$model = new JInstallationModel();
$helper = new JInstallationHelper();
//$dbo = $installHelper;

//$databaseModel = new JInstallationModelDatabase(array("dbo"=>$dbo));
//$configModel = new JInstallationModelConfiguration(array("dbo"=>$dbo));

$options = array(
	"offline" => false,
	"siteName" => "test",
	"metadesc" => "wutuututut",
	"metakeys" => "wubwubwub",
	"DBtype" => "mysql",
	"DBhostname" => "localhost",
	"DBuserName" => "root",
	"DBpassword" => "root",
	"DBname" => "joomla",
	"DBPrefix" => "jom_",
	"ftp_host" => "localhost",
	"ftp_port" => "21",
	"ftp_save" => true,
	"ftp_user" => "admin",
	"ftp_pass" => "admin",
	"ftp_root" => "/",
	"ftp_enable" => false,
	"ftpEnable" => false,
	"adminPassword" => "demo",
	"adminLogin" => "admin",
	"admin_email" => "wut@wut.com"
);

//$app = JFactory::getApplication('installation');

//$databaseModel->initialise($options);
//$configModel->setup($options);

$model->vars = $options;
$model->makeDB();
$model->saveConfig();
$helper->createAdminUser($options);