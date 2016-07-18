<?php
namespace Dennis\Seeder\Tests\Provider;

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
use Dennis\Seeder\Domain\Model;
use Dennis\Seeder\Provider\Faker;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Test case for class \Dennis\Seeder\Tests\Provider\TestDataTest
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class TestDataTest extends UnitTestCase
{
    /**
     * @var Faker $subject
     */
    protected $subject;

    /**
     * testFetchArray
     * @test
     */
    public function testFetchArray()
    {
        list($table, $faker) = $this->getMocks();

        $expected = [
            0 => [
                'uid' => 1,
                'first_name' => 'Firstname',
                'last_name' => 'Lastname',
                'mail' => 'info@example.org',
                'username' => 'foobar',
                'password' => 'someWeiredSigns',
                'address' => 'Address',
                'zip' => '12345',
                'crdate' => '54368974234',
            ]
        ];

        $testData = new \Dennis\Seeder\Provider\TestData($faker);
        $this->assertSame($expected, $testData->fetchArray($table));
    }

    /**
     * getMocks
     *
     * @return array
     */
    protected function getMocks()
    {
        $table = $this->getMock(Model\TableInterface::class);

        $columnUid = $this->getMock(Model\ColumnInterface::class);
        $columnUid->method('getName')->willReturn('uid');

        $columnFirstName = $this->getMock(Model\ColumnInterface::class);
        $columnFirstName->method('getName')->willReturn('first_name');

        $columnLastName = $this->getMock(Model\ColumnInterface::class);
        $columnLastName->method('getName')->willReturn('last_name');

        $columnMail = $this->getMock(Model\ColumnInterface::class);
        $columnMail->method('getName')->willReturn('mail');

        $columnUsername = $this->getMock(Model\ColumnInterface::class);
        $columnUsername->method('getName')->willReturn('username');

        $columnPassword = $this->getMock(Model\ColumnInterface::class);
        $columnPassword->method('getName')->willReturn('password');

        $columnAddress = $this->getMock(Model\ColumnInterface::class);
        $columnAddress->method('getName')->willReturn('address');

        $columnZip = $this->getMock(Model\ColumnInterface::class);
        $columnZip->method('getName')->willReturn('zip');

        $columnCrdate = $this->getMock(Model\ColumnInterface::class);
        $columnCrdate->method('getName')->willReturn('crdate');

        $columns = [
            $columnUid,
            $columnFirstName,
            $columnLastName,
            $columnMail,
            $columnUsername,
            $columnPassword,
            $columnAddress,
            $columnZip,
            $columnCrdate,
        ];

        $table->expects($this->any())->method('getColumns')->willReturn($columns);

        $generator = $this->getMock(\Faker\Generator::class);
        $faker = $this->getMock(Faker::class, [], [$generator]);
        $faker->expects($this->at(0))->method('get')->with('uid')->willReturn(1);
        $faker->expects($this->at(1))->method('get')->with('first_name')->willReturn('Firstname');
        $faker->expects($this->at(2))->method('get')->with('last_name')->willReturn('Lastname');
        $faker->expects($this->at(3))->method('get')->with('mail')->willReturn('info@example.org');
        $faker->expects($this->at(4))->method('get')->with('username')->willReturn('foobar');
        $faker->expects($this->at(5))->method('get')->with('password')->willReturn('someWeiredSigns');
        $faker->expects($this->at(6))->method('get')->with('address')->willReturn('Address');
        $faker->expects($this->at(7))->method('get')->with('zip')->willReturn('12345');
        $faker->expects($this->at(8))->method('get')->with('crdate')->willReturn('54368974234');

        return array($table, $faker);
    }
}
