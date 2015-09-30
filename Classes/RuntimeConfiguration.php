<?php
namespace DreadLabs\AppMigrationTypo3;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\SingletonInterface;

/**
 * RuntimeConfiguration
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class RuntimeConfiguration implements SingletonInterface {

	/**
	 * IniFileName
	 *
	 * @var string
	 */
	private $iniFileName = '.migrationrc';

	/**
	 * Settings
	 *
	 * @var array
	 */
	private $settings = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setDefaultSettings();

		if (file_exists($this->getIniFilePath())) {
			$this->settings = array_merge(
				$this->settings,
				parse_ini_string($this->getApcCacheableIniFileContent())
			);
		}
	}

	/**
	 * SetDefaultSettings
	 *
	 * @return void
	 */
	private function setDefaultSettings() {
		$this->settings = array(
			'config_file_path' => PATH_site . '/phinx.yml',
			'migration_path' => PATH_site . '/migrations/',
			'lock_path' => PATH_site . '/typo3temp/',
		);
	}

	/**
	 * GetIniFilePath
	 *
	 * @return string
	 */
	private function getIniFilePath() {
		return PATH_site . '/' . $this->iniFileName;
	}

	/**
	 * GetApcCacheableIniFileContent
	 *
	 * @see http://stackoverflow.com/a/8635782
	 * @see http://www.os-cms.net/blog/view/12/parse-ini-file-cached-with-APC
	 *
	 * @return string
	 */
	private function getApcCacheableIniFileContent() {
		ob_start();
		require_once $this->getIniFilePath();
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * GetConfigFilePath
	 *
	 * @return string
	 */
	public function getConfigFilePath() {
		return $this->settings['config_file_path'];
	}

	/**
	 * GetMigrationPath
	 *
	 * @return string
	 */
	public function getMigrationPath() {
		return $this->settings['migration_path'];
	}

	/**
	 * GetLockPath
	 *
	 * @return string
	 */
	public function getLockPath() {
		return $this->settings['lock_path'];
	}
}
