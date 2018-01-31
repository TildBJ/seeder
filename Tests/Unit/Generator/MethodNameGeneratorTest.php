<?php

namespace Dennis\Seeder\Tests\Unit\Generator;

use Dennis\Seeder\Generator;
use Dennis\Seeder\Generator\MethodNameGenerator;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Class MethodNameGeneratorTest
 *
 * @package Dennis\Seeder\Tests\Generator
 */
class MethodNameGeneratorTest extends UnitTestCase
{
    /**
     * @var Generator $subject
     */
    protected $subject;

    public function setUp()
    {
        $faker = $this->getMock(\Dennis\Seeder\Faker::class);
        $this->subject = new MethodNameGenerator($faker);
    }

    /**
     * @method generate
     * @test
     */
    public function generateReturnsIntegerIfParameterIsInteger()
    {
        $this->assertSame(4, $this->subject->generate(4));
    }

    /**
     * @method generate
     * @test
     */
    public function generateReturnsIntegerIfParameterCanBeConvertedToInteger()
    {
        $this->assertSame(4, $this->subject->generate('4'));
    }

    /**
     * @method generate
     * @test
     */
    public function generateReturnsMethodName()
    {
        $this->assertSame('$faker->getName()', $this->subject->generate('name'));
    }

    /**
     * @method generate
     * @test
     */
    public function generateReturnsNullWithInvalidParameter()
    {
        $faker = $this->getMock(\Dennis\Seeder\Faker::class);
        $faker->method('get')->willThrowException(new \Dennis\Seeder\Provider\NotFoundException());
        $generator = new MethodNameGenerator($faker);
        $this->assertSame(null, $generator->generate('InvalidParameter'));
    }
}
