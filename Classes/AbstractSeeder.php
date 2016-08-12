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
     * factory
     *
     * @var Factory $factory
     */
    protected $factory = null;

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
     * setFactory
     *
     * @param Factory $factory
     * @return void
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * seed
     *
     * @param SeedCollection $seedCollection
     * @throws Connection\NotFoundException
     * @return void
     */
    public function seed(SeedCollection $seedCollection)
    {
        if (is_null($this->connection))
        {
            throw new Connection\NotFoundException('Connection not found.');
        }

        /** @var Seed $seed */
        foreach ($seedCollection as $seed) {
            if ($seed->getProperties() === false) {
                continue;
            }
            $this->connection->fetch($seed->getTarget(), $seed->getProperties());
        }
    }
}
