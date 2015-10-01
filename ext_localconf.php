<?php
defined('TYPO3_MODE') or die();

// override core database connection class
if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('dbal')) {
	/* @var $extbaseContainer \TYPO3\CMS\Extbase\Object\Container\Container */
	$extbaseContainer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
		\TYPO3\CMS\Extbase\Object\Container\Container::class
	);

	$extbaseContainer->registerImplementation(
		\DreadLabs\AppMigration\MigratorInterface::class,
		\DreadLabs\AppMigration\Migrator\Phinx::class
	);
	$extbaseContainer->registerImplementation(
		\Phinx\Config\ConfigInterface::class,
		\DreadLabs\AppMigrationTypo3\Domain\Configuration\Typo3CmsConfiguration::class
	);
	$extbaseContainer->registerImplementation(
		\NinjaMutex\Lock\LockInterface::class,
		\DreadLabs\AppMigrationTypo3\Domain\Lock\ApplicationFlockLock::class
	);
	$extbaseContainer->registerImplementation(
		\DreadLabs\AppMigration\Lock\NinjaMutex\NameInterface::class,
		\DreadLabs\AppMigrationTypo3\Domain\Lock\Name::class
	)
	$extbaseContainer->registerImplementation(
		\DreadLabs\AppMigration\LoggerInterface::class,
		\DreadLabs\AppMigrationTypo3\Domain\Logger::class
	);
	$extbaseContainer->registerImplementation(
		\DreadLabs\AppMigration\OutputInterface::class,
		\DreadLabs\AppMigrationTypo3\Domain\Migrator\NullOutput::class
	);

	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Core\Database\DatabaseConnection::class] = array(
		'className' => \DreadLabs\AppMigrationTypo3\Database\DatabaseConnection::class
	);
}

$GLOBALS['TYPO3_CONF_VARS']['LOG']['DreadLabs']['AppMigrationTypo3']['Domain']['writerConfiguration'] = array(
	\TYPO3\CMS\Core\Log\LogLevel::EMERGENCY => array(
		\TYPO3\CMS\Core\Log\Writer\FileWriter::class => array(
			'logFile' => 'typo3temp/logs/migration.log',
		),
	),
);
