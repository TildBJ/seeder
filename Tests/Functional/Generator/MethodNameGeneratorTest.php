<?php

namespace TildBJ\Seeder\Tests\Functional;

use TildBJ\Seeder\Generator\MethodNameGenerator;

/**
 * Class MethodNameGeneratorTest
 * This class tests the functionality between MethodNameGenerator and Faker
 *
 * @package TildBJ\Seeder\Tests\Functional
 */
class MethodNameGeneratorTest extends \Nimut\TestingFramework\TestCase\UnitTestCase
{
    /**
     * @var MethodNameGenerator $subject
     */
    protected $subject;

    public function setUp()
    {
        $faker = \TildBJ\Seeder\Factory\FakerFactory::createFaker();
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
