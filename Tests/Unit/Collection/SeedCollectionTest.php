<?php
namespace TildBJ\Seeder\Tests\Unit\Collection;

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
use TildBJ\Seeder\Collection\SeedCollection;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
     * @var \TildBJ\Seeder\SeedCollection
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new SeedCollection();
    }

    /**
     * @method attach
     * @test
     */
    public function attachAttachesNewItemIfItNotExist()
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->assertSame($seed, $this->subject->current()['NEW1']);
    }

    /**
     * @method attach
     * @test
     */
    public function attachAttachesOnlyOneSeedIfSeedsAreIdentical()
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->subject->attach($seed);
        $this->assertSame([
            0 => 'NEW1',
            1 => 'NEW2',
        ], array_keys($this->subject->current()));
    }

    /**
     * @param $name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockSeed($name)
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $seed->method('getTitle')->willReturn($name);
        $seed->method('getTarget')->willReturn(strtolower(preg_replace('/\B([A-Z])/', '_$1', $name)));
        $seed->method('getProperties')->willReturn(['pid' => 123]);

        return $seed;
    }

    /**
     * @test
     * @method get
     */
    public function getReturnsArrayWithTwoKeysWhenClassNameFooBar()
    {
        $seeder = $this->createMock(\TildBJ\Seeder\Seeder::class);
        $seeder->method('getClass')->willReturn('FooBar');
        $fooBarSeed = $this->mockSeed('FooBar');
        $fooSeed = $this->mockSeed('Foo');
        $barSeed = $this->mockSeed('Bar');

        // NEW1
        $this->subject->attach($fooBarSeed);
        // NEW2
        $this->subject->attach($fooSeed);
        // NEW3
        $this->subject->attach(clone $fooBarSeed);
        // NEW4
        $this->subject->attach($barSeed);

        $this->subject->amount = 4;
        $this->assertSame([
            0 => 'NEW1',
            1 => 'NEW3',
        ], array_keys($this->subject->get($seeder)));
    }

    /**
     * @test
     * @method get
     */
    public function getReturnsArrayWithOneKeyWhenClassNameFoo()
    {
        $seeder = $this->createMock(\TildBJ\Seeder\Seeder::class);
        $seeder->method('getClass')->willReturn('Foo');
        $fooBarSeed = $this->mockSeed('FooBar');
        $fooSeed = $this->mockSeed('Foo');
        $barSeed = $this->mockSeed('Bar');

        // NEW1
        $this->subject->attach($fooBarSeed);
        // NEW2
        $this->subject->attach($fooSeed);
        // NEW3
        $this->subject->attach($fooBarSeed);
        // NEW4
        $this->subject->attach($barSeed);

        $this->subject->amount = 4;
        $this->assertSame([
            0 => 'NEW2',
        ], array_keys($this->subject->get($seeder)));
    }

    /**
     * @test
     * @method get
     */
    public function getReturnsArrayWithOneKeyWhenClassNameFooBar()
    {
        $seeder = $this->createMock(\TildBJ\Seeder\Seeder::class);
        $seeder->method('getClass')->willReturn('FooBar');
        $fooBarSeed = $this->mockSeed('FooBar');
        $fooSeed = $this->mockSeed('Foo');
        $barSeed = $this->mockSeed('Bar');

        // NEW1
        $this->subject->attach($fooBarSeed);
        // NEW2
        $this->subject->attach($fooSeed);
        // NEW3
        $this->subject->attach($fooBarSeed);
        // NEW4
        $this->subject->attach($barSeed);

        $this->subject->amount = 4;
        $this->assertSame([
            0 => 'NEW1',
            1 => 'NEW3',
        ], array_keys($this->subject->get($seeder)));
    }

    /**
     * @method clear
     * @test
     */
    public function clearSeedCollectionRemovesAllSeeds()
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->subject->clear();

        $this->assertSame([], $this->subject->toArray());
        $this->assertSame(0, $this->subject->count());
        $this->assertSame(false, $this->subject->current());
        $this->assertSame(false, $this->subject->valid());
        $this->assertSame(false, $this->subject->next());
        $this->assertSame(null, $this->subject->key());
        $this->assertSame(false, $this->subject->rewind());
    }

    /**
     * @method clear
     * @test
     */
    public function clearSeedCollectionSetCounterToZero()
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $this->subject->attach($seed);
        $this->subject->clear();
        $this->subject->attach($seed);
        $this->subject->attach(clone $seed);
        $this->assertSame([
            0 => 'NEW1',
            1 => 'NEW2',
        ], array_keys($this->subject->current()));
    }

    /**
     * @method toArray
     * @test
     */
    public function toArrayReturnsCorrectArray()
    {
        $seed = $this->createMock(\TildBJ\Seeder\Seed::class);
        $seed->method('getTitle')->willReturn('FooBar');
        $seed->method('getTarget')->willReturn('foo_bar');
        $seed->method('getProperties')->willReturn(['pid' => 123]);
        $this->subject->attach($seed);
        $this->subject->attach(clone $seed);
        $this->assertSame([
            'foo_bar' => [
                'NEW1' => [
                    'pid' => 123
                ],
                'NEW2' => [
                    'pid' => 123
                ],
            ],
        ], $this->subject->toArray());
    }

    public function tearDown()
    {
        $this->subject->clear();
    }
}
