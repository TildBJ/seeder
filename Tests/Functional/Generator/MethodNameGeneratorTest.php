<?php

namespace Dennis\Seeder\Tests\Functional;

use Dennis\Seeder\Generator\MethodNameGenerator;


/**
 * Class MethodNameGeneratorTest
 * This class tests the functionality between MethodNameGenerator and Faker
 *
 * @package Dennis\Seeder\Tests\Functional
 */
class MethodNameGeneratorTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var MethodNameGenerator $subject
     */
    protected $subject;

    public function setUp()
    {
        $faker = \Dennis\Seeder\Factory\FakerFactory::createFaker();
        $this->subject = new MethodNameGenerator($faker);
    }

    /**
     * @method generate
     * @test
     */
    public function generateWithBodytextGeneratesGetTextAsMethodName()
    {
        $this->assertSame('$faker->getText()', $this->subject->generate('bodytext'));
    }

    /**
     * @method generate
     * @test
     */
    public function generateWithDescriptionGeneratesGetTextAsMethodName()
    {
        $this->assertSame('$faker->getText()', $this->subject->generate('description'));
    }

    /**
     * @method generate
     * @test
     */
    public function generateWithTstampGeneratesGetUnixtimeAsMethodName()
    {
        $this->assertSame('$faker->getUnixtime()', $this->subject->generate('tstamp'));
    }
}
