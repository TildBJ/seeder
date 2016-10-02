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
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
     * @var SeederFactory $factory
     */
    protected $factory = null;

    /**
     * AbstractSeeder constructor.
     */
    public function __construct()
    {
        $this->factory = GeneralUtility::makeInstance(Factory\SeederFactory::class);
    }

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
     * preProcess
     *
     * @return void
     */
    abstract protected function before();

    /**
     * after
     *
     * @return void
     */
    abstract protected function after();

    /**
     * seed
     *
     * @param SeedCollection $seedCollection
     * @param array $overrideProperties
     * @throws Connection\NotFoundException
     * @return bool
     */
    final public function seed(SeedCollection $seedCollection, array $overrideProperties = [])
    {
        $this->before();

        if (is_null($this->connection)) {
            throw new Connection\NotFoundException('Connection not found.');
        }

        $seedCollection = $this->run();

        foreach ($overrideProperties as $column => $value) {
            /** @var Seed $seed */
            foreach ($seedCollection as $seed) {
                $seed->set([$column => $value]);
            }
        }

        $success = false;

        /** @var Seed $seed */
        foreach ($seedCollection as $seed) {
            if ($seed->getProperties() === false) {
                continue;
            }
            $success = $this->connection->fetch($seed);
        }

        $this->after();

        return $success;
    }

    /**
     * @param $className
     * @return \Closure
     */
    final protected function call($className)
    {
        /** @var self $class */
        $class = new $className;

        return function($lastInsertId, $column) use ($class) {
            /** @var \Dennis\Seeder\Collection\SeedCollection $seedCollection */
            $seedCollection = GeneralUtility::makeInstance(\Dennis\Seeder\Collection\SeedCollection::class);
            $class->seed($seedCollection, [$column => $lastInsertId]);

            return $seedCollection->count();
        };
    }
}
