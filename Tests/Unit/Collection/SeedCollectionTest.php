<?php
namespace Dennis\Seeder\Tests\Unit\Collection;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2018 Dennis Römmich <dennis@roemmich.eu>
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
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * SeedCollectionTest
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeedCollectionTest extends UnitTestCase
{
    /**
     * @var \Dennis\Seeder\SeedCollection
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new \Dennis\Seeder\Collection\SeedCollection();
    }

    /**
     * @method attach
     * @test
     */
    public function attachAttachesNewItemIfItNotExist()
    {
        $seed = $this->getMock(\Dennis\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->assertSame($seed, $this->subject->current()['NEW1']);
    }

    /**
     * @method attach
     * @test
     */
    public function attachAttachesOnlyOneSeedIfSeedsAreIdentical()
    {
        $seed = $this->getMock(\Dennis\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->subject->attach($seed);
        $this->assertSame([
            0 => 'NEW1',
        ], array_keys($this->subject->current()));
    }

    /**
     * @method attach
     * @test
     */
    public function attachAttachesMultipleSeedsIfSeedsAreDifferent()
    {
        $seed = $this->getMock(\Dennis\Seeder\Seed::class);
        $differentSeed = $this->getMock(\Dennis\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->subject->attach($differentSeed);
        $this->assertSame([
            0 => 'NEW1',
            1 => 'NEW2',
        ], array_keys($this->subject->current()));
    }
}
