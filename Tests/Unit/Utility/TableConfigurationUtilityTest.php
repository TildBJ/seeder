<?php
namespace Dennis\Seeder\Tests\Utility;

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
use Dennis\Seeder\Tests\AccessibleTraitForTest;
use Dennis\Seeder\Traits\Language;
use Dennis\Seeder\Utility\TableConfigurationUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use Dennis\Seeder\Traits;

/**
 * Test case for class \Dennis\Seeder\Tests\Utility\TableConfigurationUtilityTest
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class TableConfigurationUtilityTest extends UnitTestCase
{
	use Language, AccessibleTraitForTest;

	/**
	 * subject
	 *
	 * @var TableConfigurationUtility $subject
	 */
	protected $subject;

	/**
	 * TABLE
	 */
	const TABLE = 'pages';

	/**
	 * setUp
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

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
				],
			],
		];

		$this->subject = $this->getMock(
			$this->buildAccessibleProxy(TableConfigurationUtility::class),
			['translate'],
			['pages']
		);
	}

	/**
	 * tableConfigurationContainsArray
	 * @test
	 */
	public function tableConfigurationContainsArray()
	{
		$tableConfiguration = $this->accessProtectedProperty($this->subject, 'tableConfiguration');
		$this->assertTrue(is_array($tableConfiguration));
	}

	/**
	 * tablePropertyContainsString
	 * @test
	 */
	public function tablePropertyContainsString()
	{
		$table = $this->accessProtectedProperty($this->subject, 'table');
		$this->assertSame(self::TABLE, $table);
	}

	/**
	 * getNameReturnsTableName
	 * @test
	 */
	public function getNameReturnsTableName()
	{
		$this->assertSame(self::TABLE, $this->subject->getName());
	}

	/**
	 * getTitleReturnsTitleOfTable
	 * @test
	 */
	public function getTitleReturnsTitleOfTable()
	{
		$this->subject->expects($this->once())
			->method('translate')
			->will($this->returnValue('Pages'));
		$this->assertSame('Pages', $this->subject->getTitle());
	}

	/**
	 * getColumnsReturnsArray
	 * @test
	 */
	public function getColumnsReturnsArray()
	{
		$this->assertTrue(is_array($this->subject->getColumns()));
	}

	/**
	 * getColumnConfigurationThrowsExceptionWhenTableNotExist
	 * @test
	 */
	public function getColumnConfigurationThrowsExceptionWhenTableNotExist()
	{
		$column = 'FooBar';
		$this->setExpectedException('InvalidArgumentException', 'Column ' . $column . ' does not exist for table ' . self::TABLE);
		$this->assertSame($this->getExpectedException(), $this->subject->getColumnConfiguration($column));
	}

	/**
	 * getColumnConfigurationReturnsArray
	 * @test
	 */
	public function getColumnConfigurationReturnsArray()
	{
		$this->assertTrue(is_array($this->subject->getColumnConfiguration('title')));
	}
}
