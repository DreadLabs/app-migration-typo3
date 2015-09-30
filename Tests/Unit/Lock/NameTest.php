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
use DreadLabs\AppMigrationTypo3\Domain\Lock\Name;

/**
 * NameTest
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class NameTest extends \PHPUnit_Framework_TestCase {

	/**
	 * ItHasSpecificValue
	 *
	 * @return void
	 */
	public function testItHasSpecificValue() {
		$name = new Name();

		$this->assertEquals('typo3-cms-migration', $name->__toString());
	}

	/**
	 * ItHasSpecificValueIfStringCasted
	 *
	 * @return void
	 */
	public function testItHasSpecificValueIfStringCasted() {
		$name = new Name();

		$this->assertEquals('typo3-cms-migration', (string) $name);
	}
}
