<?php

namespace Dennis\Seeder\Generator;

/**
 * Class MethodNameGenerator
 *
 * @package Dennis\Seeder\Generator
 */
class MethodNameGenerator implements \Dennis\Seeder\Generator
{
    /**
     * @var \Dennis\Seeder\Faker $faker
     */
    protected $faker;

    /**
     * MethodNameGenerator constructor.
     */
    public function __construct(\Dennis\Seeder\Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @return mixed|void
     */
    public function generate($parameter)
    {
        if (is_numeric($parameter)) {
            return (int) $parameter;
        }
        try {
            $this->faker->get($parameter);
            return self::PREFIX . ucfirst($parameter) . self::SUFFIX;
        } catch (\Dennis\Seeder\Provider\NotFoundException $exception) {
            return null;
        }
    }
}
