<?php
namespace TildBJ\Seeder\Tests\Unit\Provider;

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
use TildBJ\Seeder\Tests\Unit\AccessibleTraitForTest;
use TildBJ\Seeder\Traits\Language;
use TildBJ\Seeder\Provider\TableConfiguration;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case for class \TildBJ\Seeder\Tests\Provider\TableConfigurationTest
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class TableConfigurationTest extends UnitTestCase
{
    use Language, AccessibleTraitForTest;

    /**
     * @var TableConfiguration $subject
     */
    protected $subject;

    /**
     * TABLE
     */
    const TABLE = 'pages';

    /**
     * @return void
     */
    public function setUp()
    {
        $GLOBALS['LANG'] = new \TYPO3\CMS\Lang\LanguageService();
        $GLOBALS['LANG']->init('de');

        $GLOBALS['TCA'] = [
            'pages' => [
                'ctrl' => [
                    'title' => 'LLL:EXT:lang/locallang_tca.xlf:pages'
                ],
                'columns' => [
                    'title' => [
                        'config' => [
                            'type' => 'array',
                            'size' => '50',
                            'max' => '255',
                            'eval' => 'trim,required',
                        ],
                    ],
                    'doctype' => [
                        'exclude' => 1,
                        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.type',
                        'config' => [
                           'type' => 'select',
                           'renderType' => 'selectSingle',
                           'default' => '1'
                        ],
                    ],
                ],
            ],
            'fe_users' => [],
        ];

        $this->subject = new TableConfiguration('pages');
    }

    /**
     * @test
     */
    public function createTableConfigurationThrowsExceptionWhenTableNameNotExist()
    {
        $this->expectException(\InvalidArgumentException::class);
        new TableConfiguration('LoremIpsum');
    }

    /**
     * @test
     */
    public function createTableConfigurationThrowsExceptionWhenArgumentIsNoString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->subject->getColumnConfiguration(123);
    }

    /**
     * @test
     */
    public function tableConfigurationContainsArray()
    {
        $tableConfiguration = $this->accessProtectedProperty($this->subject, 'tableConfiguration');
        $this->assertTrue(is_array($tableConfiguration));
    }

    /**
     * @test
     */
    public function tablePropertyContainsString()
    {
        $table = $this->accessProtectedProperty($this->subject, 'name');
        $this->assertSame(self::TABLE, $table);
    }

    /**
     * @test
     */
    public function getNameReturnsTableName()
    {
        $this->assertSame(self::TABLE, $this->subject->getName());
    }

    /**
     * @test
     */
    public function getTitleReturnsTitleOfTable()
    {
        $this->assertSame('Page', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getColumnsReturnsArray()
    {
        $this->assertSame(['title', 'doctype'], $this->subject->getColumns());
    }

    /**
     * @test
     */
    public function getColumnConfigurationThrowsExceptionWhenTableNotExist()
    {
        $column = 'FooBar';
        $this->expectException(
            'InvalidArgumentException',
            'Column ' . $column . ' does not exist for table ' . self::TABLE
        );
        $this->assertSame($this->getExpectedException(), $this->subject->getColumnConfiguration($column));
    }

    /**
     * @test
     */
    public function getColumnConfigurationReturnsArray()
    {
        $expected = [
            'title' => [
                'type' => 'array',
                'size' => '50',
                'max' => '255',
                'eval' => 'trim,required',
            ],
        ];
        $this->assertSame($expected, $this->subject->getColumnConfiguration('title'));
    }

    /**
     * @test
     */
    public function getAllTablesReturnsArray()
    {
        $this->assertSame(['pages' => 'pages', 'fe_users' => 'fe_users'], $this->subject->getAllTables());
    }
}
