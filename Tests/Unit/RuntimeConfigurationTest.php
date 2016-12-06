<?php
namespace DreadLabs\AppMigrationTypo3\Tests\Unit;

/*
 * This file is part of the `DreadLabs/app-migration-typo3` project.
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

/**
 * RuntimeConfigurationTest
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class RuntimeConfigurationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * ItUsesDefaultSettingsIfNoIniFileExists
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testItUsesDefaultSettingsIfNoIniFileExists()
    {
        define('PATH_site', __DIR__ . '/../Fixtures');

        $configuration = new RuntimeConfiguration();

        $this->assertEquals(__DIR__ . '/../Fixtures/phinx.yml', $configuration->getConfigFilePath());
        $this->assertEquals(__DIR__ . '/../Fixtures/migrations/', $configuration->getMigrationPath());
        $this->assertEquals(__DIR__ . '/../Fixtures/typo3temp/', $configuration->getLockPath());
    }

    /**
     * ItUsesSettingsFromExistingIniFile
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testItUsesSettingsFromExistingIniFile()
    {
        define('PATH_site', __DIR__ . '/../Fixtures/RuntimeConfiguration/Full');

        $configuration = new RuntimeConfiguration();

        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Full/../phinx.yml', $configuration->getConfigFilePath());
        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Full/../migrations/', $configuration->getMigrationPath());
        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Full/typo3temp/', $configuration->getLockPath());
    }

    /**
     * ItMergesDefaultSettingsIfExistingIniFileIsIncomplete
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testItMergesDefaultSettingsIfExistingIniFileIsIncomplete()
    {
        define('PATH_site', __DIR__ . '/../Fixtures/RuntimeConfiguration/Partial');

        $configuration = new RuntimeConfiguration();

        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Partial/phinx.yml', $configuration->getConfigFilePath());
        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Partial/migrations/', $configuration->getMigrationPath());
        $this->assertEquals(__DIR__ . '/../Fixtures/RuntimeConfiguration/Partial/typo3temp/', $configuration->getLockPath());
    }
}
