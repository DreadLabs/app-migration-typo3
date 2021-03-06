<?php
namespace DreadLabs\AppMigrationTypo3\Database;

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

use DreadLabs\AppMigration\Exception\MigrationException;
use DreadLabs\AppMigration\MediatorInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

/**
 * DatabaseConnection
 *
 * Slim wrapper around the TYPO3.CMS Core's DatabaseConnection class in order
 * to perform migration during application runtime.
 *
 * Note, that this class is *NOT* loaded / registered if ext:dbal is active.
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class DatabaseConnection extends \TYPO3\CMS\Core\Database\DatabaseConnection
{

    /**
     * Mediator
     *
     * @var MediatorInterface
     */
    private $mediator;

    /**
     * Open a (persistent) connection to a MySQL server
     *
     * @throws \RuntimeException Thrown in parent if php ext mysqli is not loaded.
     * @throws MigrationException If something went wrong during migration
     * @return bool|void
     */
    public function sql_pconnect()
    {
        $link = parent::sql_pconnect();

        $this->initializeMediator();
        $this->mediator->negotiate();

        return $link;
    }

    /**
     * Initializes a mediator instance
     *
     * @return void
     */
    private function initializeMediator()
    {
        if (is_null($this->mediator)) {
            $this->mediator = $this->getObjectManager()->get(MediatorInterface::class);
        }
    }

    /**
     * Returns an object manager instance
     *
     * @return ObjectManagerInterface
     */
    private function getObjectManager()
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }
}
