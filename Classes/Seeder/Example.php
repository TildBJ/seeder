<?php

namespace Dennis\Seeder\Seeder;

use Dennis\Seeder;

/**
 * Class Example
 * @package Dennis\Seeder\Seeder
 */
class Example extends \Dennis\Seeder\Seeder\DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->create('tx_myextension_domain_model_mymodel')->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set(
                array (
                  'pid' => 1,
                  'sys_language_uid' => 0,
                  'hidden' => 0,
                  'title' => $faker->getTitle(),
                  'description' => $faker->getText(),
                  'relation' => $this->call(\Dennis\Seeder\Seeder\RelationExample::class),
                )
            );
        });
    }
}
