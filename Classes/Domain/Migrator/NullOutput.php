<?php
namespace DreadLabs\AppMigrationTypo3\Domain\Migrator;

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

use DreadLabs\AppMigration\Migrator\Phinx\OutputInterface;

/**
 * NullOutput
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 */
class NullOutput extends \Symfony\Component\Console\Output\NullOutput implements OutputInterface
{
}
