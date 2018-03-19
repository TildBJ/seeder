<?php
namespace TildBJ\Seeder\Tests\Functional\Seeder;

use TildBJ\Seeder;

/**
 * Class User
 * @package TildBJ\Seeder\Seeder
 *
 * @example
 */
class SubGroup extends Seeder\Seeder\DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->create('fe_groups', 2)->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set([
                'title' => 'SubGroup',
            ]);
        });
    }
}
