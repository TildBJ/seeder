<?php
namespace Dennis\Seeder\Connection;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
use Dennis\Seeder\Connection;

/**
 * InstallController
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class DatabaseConnection implements Connection
{
    /**
     * connection
     *
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection $connection
     */
    protected $connection;

    /**
     * DatabaseConnection constructor.
     * @param \TYPO3\CMS\Core\Database\DatabaseConnection $connection
     */
    public function __construct(\TYPO3\CMS\Core\Database\DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * fetch
     *
     * @param string $tableName
     * @param array $data
     * @return void
     */
    public function fetch($tableName, array $data)
    {
        $this->connection->exec_INSERTquery($tableName, $data);
    }
}
