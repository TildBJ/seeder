<?php
namespace TildBJ\Seeder\Factory;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
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
use TildBJ\Seeder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SeederFactory
 *
 * @package TildBJ\Seeder\Factory\SeederFactory
 */
class SeederFactory implements \TildBJ\Seeder\SeederFactory, \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var Seeder\Faker
     */
    protected $faker;

    public function __construct(Seeder\Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Creates a new SeedCollection
     *
     * @param string $name
     * @param int $limit
     * @return Seeder\SeedCollection
     */
    public function create($name, $limit = 1)
    {
        $calledClass = debug_backtrace(false, 2)[1]['class'];

        return $this->fillSeedCollection($calledClass, $name, $limit, true);
    }

    /**
     * @param $name
     * @param int $limit
     * @return Seeder\SeedCollection|mixed
     */
    public function make($name, $limit = 1)
    {
        $calledClass = debug_backtrace(false, 2)[1]['class'];

        return $this->fillSeedCollection($calledClass, $name, $limit);
    }

    /**
     * @param $calledClass
     * @param $name
     * @param int $limit
     * @return Seeder\SeedCollection
     */
    protected function fillSeedCollection($calledClass, $name, $limit = 1, $force = false)
    {
        /** @var Seeder\Provider\TableConfiguration $tableConfiguration */
        $tableConfiguration = GeneralUtility::makeInstance(Seeder\Provider\TableConfiguration::class, $name);

        /** @var Seeder\SeedCollection $seedCollection */
        $seedCollection = GeneralUtility::makeInstance(Seeder\Collection\SeedCollection::class);

        $seeds = [];
        for ($i = 1; $i <= $limit; $i++) {
            /** @var Seeder\Seed $seed */
            $seed = GeneralUtility::makeInstance(Seeder\Domain\Model\Seed::class);
            $seed->setTarget($name)
                ->setTitle($calledClass)
                ->setProperties($tableConfiguration->getColumns());
            $seeds[$i] = $seed;
        }

        if ($force) {
            foreach ($seeds as $seed) {
                $seedCollection->attach($seed);
            }
        } else {
            $amount = count($seeds) - $seedCollection->countByName($calledClass);
            for ($i = 1; $i <= $amount; $i++) {
                $seedCollection->attach($seeds[$i]);
            }
        }

        return $seedCollection;
    }
}
