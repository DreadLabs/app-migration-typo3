<?php
defined('TYPO3_MODE') or die();

// override core database connection class
if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('dbal')) {
	/* @var $extbaseObjectContainer \TYPO3\CMS\Extbase\Object\Container\Container */
	$extbaseObjectContainer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
		\TYPO3\CMS\Extbase\Object\Container\Container::class
	);

	$extbaseObjectContainer->registerImplementation(
		\DreadLabs\AppMigration\MigratorInterface::class,
		\DreadLabs\AppMigration\Migrator\Phinx::class
	);
	$extbaseObjectContainer->registerImplementation(
		\Phinx\Config\ConfigInterface::class,
		\DreadLabs\AppMigration\App\Typo3\Domain\Configuration\Typo3CmsConfiguration::class
	);
	$extbaseObjectContainer->registerImplementation(
		\NinjaMutex\Lock\LockInterface::class,
		\DreadLabs\AppMigration\App\Typo3\Domain\Lock\Typo3TempFlockLock::class
	);
	$extbaseObjectContainer->registerImplementation(
		\DreadLabs\AppMigration\LoggerInterface::class,
		\DreadLabs\AppMigration\App\Typo3\Domain\Logger::class
	);
	$extbaseObjectContainer->registerImplementation(
		\DreadLabs\AppMigration\OutputInterface::class,
		\DreadLabs\AppMigration\App\Typo3\Domain\NullOutput::class
	);

	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Core\Database\DatabaseConnection::class] = array(
		'className' => \DreadLabs\AppMigration\App\Typo3\Database\DatabaseConnection::class
	);
}

$GLOBALS['TYPO3_CONF_VARS']['LOG']['DreadLabs']['AppMigration']['App']['Typo3']['Domain']['writerConfiguration'] = array(
	\TYPO3\CMS\Core\Log\LogLevel::EMERGENCY => array(
		\TYPO3\CMS\Core\Log\Writer\FileWriter::class => array(
			'logFile' => 'typo3temp/logs/migration.log',
		),
	),
);
