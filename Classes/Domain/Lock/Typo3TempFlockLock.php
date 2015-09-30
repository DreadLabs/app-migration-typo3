<?php
namespace DreadLabs\AppMigrationTypo3\Domain\Lock;

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

use DreadLabs\AppMigrationTypo3\RuntimeConfiguration;
use NinjaMutex\Lock\FlockLock;

/**
 * Typo3TempFlockLock
 *
 * Extends the NinjaMutex Flocklock with a directly set
 * lock file path to the TYPO3.CMS temp directory.
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class Typo3TempFlockLock extends FlockLock {

	/**
	 * Constructor
	 *
	 * @param RuntimeConfiguration $configuration RuntimeConfiguration
	 */
	public function __construct(RuntimeConfiguration $configuration) {
		parent::__construct($configuration->getLockPath());
	}
}
