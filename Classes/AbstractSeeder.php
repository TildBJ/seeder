<?php
namespace Dennis\Seeder;

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
use Dennis\Seeder\Domain\Model\SeedInterface;

/**
 * Seeder
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
abstract class AbstractSeeder implements Seeder
{
    /**
     * connection
     *
     * @var Connection $connection
     */
    protected $connection = null;

    /**
     * setConnection
     *
     * @param Connection $connection
     * @return void
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Runs the Seeder process. Returns true if succeed.
     *
     * @param SeedInterface $seed
     * @throws Connection\NotFoundException
     * @return boolean
     */
    public function run(SeedInterface $seed)
    {
        if (is_null($this->connection))
        {
            throw new \Dennis\Seeder\Connection\NotFoundException('Connection Not Found.');
        }

        if ($seed->getProperties() === false) {
            return false;
        }
        $this->connection->fetch($seed->getTarget(), $seed->getProperties());
        return true;
    }
}
