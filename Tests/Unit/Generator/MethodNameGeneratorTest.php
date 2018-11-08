<?php

namespace TildBJ\Seeder\Tests\Unit\Generator;

use TildBJ\Seeder\Generator;
use TildBJ\Seeder\Generator\MethodNameGenerator;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Class MethodNameGeneratorTest
 *
 * @package TildBJ\Seeder\Tests\Generator
 */
class MethodNameGeneratorTest extends UnitTestCase
{
    /**
     * @var Generator $subject
     */
    protected $subject;

    public function setUp()
    {
        $faker = $this->createMock(\TildBJ\Seeder\Faker::class);
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
        $faker = $this->createMock(\TildBJ\Seeder\Faker::class);
        $faker->method('get')->willThrowException(new \TildBJ\Seeder\Provider\NotFoundException());
        $generator = new MethodNameGenerator($faker);
        $this->assertSame(null, $generator->generate('InvalidParameter'));
    }
}
