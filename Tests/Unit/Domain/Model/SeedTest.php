<?php
namespace Dennis\Seeder\Tests\Domain\Model;

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
use Dennis\Seeder\Domain\Model\Seed;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * SeedTest
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeedTest extends UnitTestCase
{

    /**
     * subject
     *
     * @var Seed $subject
     */
    protected $subject;

    /**
     * Properties
     */
    protected $properties = [
        'key' => 'value',
        'foo' => 'bar',
    ];

    /**
     * setUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->subject = new Seed();
    }

    /**
     * setTitleForStringSetsTitle
     *
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('MyTitle');

        $this->assertAttributeEquals(
            'MyTitle',
            'title',
            $this->subject
        );
    }

    /**
     * setTitleReturnsSelf
     *
     * @test
     */
    public function setTitleReturnsSelf()
    {
        $this->assertEquals($this->subject, $this->subject->setTitle('FooBar'));
    }

    /**
     * setPropertiesForArraySetsProperties
     *
     * @test
     */
    public function setPropertiesForArraySetsProperties()
    {
        $this->subject->setProperties($this->properties);

        $this->assertAttributeEquals($this->properties, 'properties', $this->subject);
    }

    /**
     * setPropertiesReturnsSelf
     *
     * @test
     */
    public function setPropertiesReturnsSelf()
    {
        $this->assertEquals($this->subject, $this->subject->setProperties($this->properties));
    }
}
