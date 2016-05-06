<?php
namespace Dennis\Seeder\Tests\Traits;

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
use Dennis\Seeder\Tests\Accessible;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use Dennis\Seeder\Traits;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Test case for class \Dennis\Seeder\Tests\Traits\LanguageTest
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class LanguageTest extends UnitTestCase
{
	use Accessible;

	/**
	 * subject
	 *
	 * @var Traits\Language $subject
	 */
	protected $subject;

	/**
	 * setUp
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		$GLOBALS['LANG'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(LanguageService::class);
		$GLOBALS['LANG']->init('default');

		$this->subject = $this->getObjectForTrait(Traits\Language::class);
	}

	/**
	 * translateReturnsTranslatedString
	 * @test
	 */
	public function translateReturnsTranslatedString()
	{
		$translation = $this->accessProtectedMethod($this->subject, 'translate', 'LLL:EXT:lang/locallang_tca.xlf:pages');
		$this->assertSame('Page', $translation);
	}

	/**
	 * translateWithWrongArgumentShouldReturnEmptyString
	 * @test
	 */
	public function translateWithWrongLLLKeyReturnsEmptyString()
	{
		$translation = $this->accessProtectedMethod($this->subject, 'translate', 'LLL:EXT:lang/locallang_tca.xlf:FooBar');
		$this->assertSame('', $translation);
	}

	/**
	 * translateWithRandomStringReturnsRandomString
	 * @test
	 */
	public function translateWithRandomStringReturnsRandomString()
	{
		$translation = $this->accessProtectedMethod($this->subject, 'translate', 'FooBar');
		$this->assertSame('FooBar', $translation);
	}
}
