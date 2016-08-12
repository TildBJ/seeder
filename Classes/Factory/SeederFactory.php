<?php
namespace Dennis\Seeder\Factory;

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
use Dennis\Seeder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SeederFactory
 *
 * @package Dennis\Seeder\Factory\SeederFactory
 */
class SeederFactory implements \Dennis\Seeder\Factory, \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * Creates a new SeedCollection
     *
     * @param string $name
     * @param int $limit
     * @return Seeder\SeedCollection
     */
    public function create($name, $limit = 1)
    {
        /** @var Seeder\SeedCollection $seedCollection */
        $seedCollection = GeneralUtility::makeInstance(Seeder\Collection\SeedCollection::class);
        for ($i = 1; $i <= $limit; $i++) {
            /** @var Seeder\Seed $seed */
            $seed = GeneralUtility::makeInstance(Seeder\Domain\Model\Seed::class);
            $seed->setTarget($name);
            $seedCollection->attach($seed);
        }

        return $seedCollection;
    }
}
