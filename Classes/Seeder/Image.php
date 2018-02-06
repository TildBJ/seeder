<?php

namespace Dennis\Seeder\Seeder;

use Dennis\Seeder;

/**
 * Class Image
 * @package Dennis\Seeder\Seeder
 */
class Image extends \Dennis\Seeder\Seeder\DatabaseSeeder
{
    public function run()
    {
        $this->factory->create('sys_file_reference')->each(
            function (Seeder\Seed $seed, Seeder\Faker $faker) {
                $seed->set(
                    array(
                        'pid' => 0,
                        'uid_local' => $faker->getImage(),
                    )
                );
            }
        );
    }
}
