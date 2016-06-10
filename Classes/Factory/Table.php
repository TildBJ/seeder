<?php
namespace Dennis\Seeder\Factory;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis.roemmich@sunzinet.com>, sunzinet AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use Dennis\Seeder\Provider\TableConfiguration;

/**
 * Class Table
 *
 * @package Dennis\Seeder\Factory\Table
 */
class Table
{
    /**
     * @var array
     */
    protected static $tables = [];

    protected function __construct()
    {
    }

    /**
     * Provides a Table
     *
     * @param string $tableName
     * @param TableConfiguration $tableConfiguration
     * @return \Dennis\Seeder\Domain\Model\TableInterface
     */
    public static function getInstance($tableName, TableConfiguration $tableConfiguration)
    {
        if (!in_array($tableName, self::$tables)) {
            self::$tables[$tableName] = new \Dennis\Seeder\Domain\Model\Table($tableConfiguration);
        }

        return self::$tables[$tableName];
    }
}
