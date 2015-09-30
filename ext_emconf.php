<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "app_migration_typo3".
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'DreadLabs/AppMigration: TYPO3.CMS integration',
	'description' => 'Integrates the dreadlabs/app-migration infrastructure into TYPO3.CMS.',
	'category' => 'fe',
	'author' => 'Thomas Juhnke',
	'author_email' => 'typo3@van-tomas.de',
	'shy' => '',
	'dependencies' => 'cms,extbase',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.4.0-7.4.99',
			'extbase' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => '',
);
