<?php
namespace DreadLabs\AppMigrationTypo3\Tests\Unit\Lock;

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
use DreadLabs\AppMigrationTypo3\Domain\Lock\ApplicationFlockLock;
use DreadLabs\AppMigrationTypo3\RuntimeConfiguration;

/**
 * ApplicationFlockLockTest
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class ApplicationFlockLockTest extends \PHPUnit_Framework_TestCase {

	/**
	 * ItFetchesThePathFromRuntimeConfigurationOnConstruction
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function testItFetchesThePathFromRuntimeConfigurationOnConstruction() {
		define('PATH_site', __DIR__);

		$runtimeConfiguration = $this->getMock(RuntimeConfiguration::class);

		$runtimeConfiguration->expects($this->once())->method('getLockPath')->willReturn('/foo/bar/typo3temp');

		new ApplicationFlockLock($runtimeConfiguration);
	}
}
