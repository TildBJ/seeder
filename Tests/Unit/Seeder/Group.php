<?php
namespace Dennis\Seeder\Tests\Seeder;

use Dennis\Seeder;

/**
 * Class User
 * @package Dennis\Seeder\Seeder
 *
 * @example
 */
class Group extends Seeder\Seeder\DatabaseSeeder
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
                'title' => 'Group',
                'subgroup' => $this->call(SubGroup::class),
            ]);
        });
    }
}
