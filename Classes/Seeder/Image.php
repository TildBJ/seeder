<?php

namespace TildBJ\Seeder\Seeder;

use TildBJ\Seeder;

/**
 * Class Image
 * @package TildBJ\Seeder\Seeder
 */
class Image extends \TildBJ\Seeder\Seeder\DatabaseSeeder
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
