<?php
namespace Dennis\Seeder\Tests\Seeder;

use Dennis\Seeder;

/**
 * Class User
 * @package Dennis\Seeder\Seeder
 */
class Group
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->create('fe_groups', 2)->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {

        });
    }
}
