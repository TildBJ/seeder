<?php
declare(strict_types=1);

namespace TildBJ\Seeder\Tests\Unit\Factory;

use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Class FakerFactoryTest
 */
class FakerFactoryTest extends UnitTestCase
{
    /**
     * @test
     */
    public function testCreateFaker()
    {
        $instance = \TildBJ\Seeder\Factory\FakerFactory::createFaker();
        $this->assertInstanceOf(\TildBJ\Seeder\Faker::class, $instance);
    }

    /**
     * @test
     */
    public function testIfFakerFactoryAlwayReturnsTheSameObject()
    {
        $firstInstance = \TildBJ\Seeder\Factory\FakerFactory::createFaker();
        $secondInstance = \TildBJ\Seeder\Factory\FakerFactory::createFaker();

        $this->assertSame($firstInstance, $secondInstance);
    }
}
