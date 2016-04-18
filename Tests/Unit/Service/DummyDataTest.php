<?php
namespace Dennis\Seeder\Tests\Servcie;

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
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Test case for class \Dennis\Seeder\Tests\Main\TestTest
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class DummyDataTest extends UnitTestCase
{
    protected $types = [
        'firstname',
        'surname',
        'username',
        'company',
        'title',
        'address',
        'zip',
        'city',
        'country',
        'phone',
        'email',
        'url',
        'image',
        'coords',
    ];

    protected $pathToData = 'Resources/Private/Data/';

    /**
     * testsCanBeExecuted
     *
     * @test
     * @return void
     */
    public function dataIsAvailable()
    {
        foreach ($this->types as $type)
        {
            $file = $this->pathToData . $type . '.json';

            $this->assertFileExists(
                $file,
                'File ' . $file . ' does not exist!'
            );
        }
    }

    /**
     * dataContainsValidJson
     *
     * @test
     * @return void
     */
    public function dataContainsValidJson()
    {
        foreach ($this->types as $type)
        {
            $file = $this->pathToData . $type . '.json';

            $content = file_get_contents($file);

            $this->assertJson(
                $content,
                'File ' . $file . ' does not contain valid JSON!'
            );
        }
    }

    /**
     * dataContainsMoreThanHundredValues
     *
     * @test
     * @return void
     */
    public function dataContainsMoreThanThreeValues()
    {
        foreach ($this->types as $type)
        {
            $file = $this->pathToData . $type . '.json';

            $content = file_get_contents($file);

            $json = json_decode($content);

            $this->assertGreaterThan(
                3,
                count($json->data),
                'File ' . $file . ' does not contain more than hundred values!'
            );
        }
    }

}