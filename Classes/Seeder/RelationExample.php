<?php

namespace Dennis\Seeder\Seeder;

use Dennis\Seeder;

/**
 * Class RelationExample
 * @package Dennis\Seeder\Seeder
 */
class RelationExample extends \Dennis\Seeder\Seeder\DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->create('tx_myextension_domain_model_myrelation', 5)->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set(
                array (
                  'pid' => 1,
                  'sys_language_uid' => 0,
                  'hidden' => 0,
                  'title' => $faker->getTitle(),
                )
            );
        });
    }
}
