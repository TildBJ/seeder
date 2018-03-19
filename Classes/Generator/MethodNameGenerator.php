<?php

namespace TildBJ\Seeder\Generator;

/**
 * Class MethodNameGenerator
 *
 * @package TildBJ\Seeder\Generator
 */
class MethodNameGenerator implements \TildBJ\Seeder\Generator
{
    /**
     * @var \TildBJ\Seeder\Faker $faker
     */
    protected $faker;

    /**
     * MethodNameGenerator constructor.
     */
    public function __construct(\TildBJ\Seeder\Faker $faker)
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
        if ($this->faker->guessProviderName($parameter)) {
            $parameter = $this->faker->guessProviderName($parameter);
        }
        try {
            $this->faker->get($parameter);
            return self::PREFIX . ucfirst($parameter) . self::SUFFIX;
        } catch (\TildBJ\Seeder\Provider\NotFoundException $exception) {
            return null;
        }
    }
}
