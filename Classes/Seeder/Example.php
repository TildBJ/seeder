<?php

namespace TildBJ\Seeder\Seeder;

use TildBJ\Seeder;

/**
 * Class Example
 * @package TildBJ\Seeder\Seeder
 */
class Example extends \TildBJ\Seeder\Seeder\DatabaseSeeder
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
                  'relation' => $this->call(\TildBJ\Seeder\Seeder\RelationExample::class),
                )
            );
        });
    }
}
