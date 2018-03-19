<?php
namespace TildBJ\Seeder\Tests\Functional\Seeder;

use TildBJ\Seeder;

/**
 * Class Group
 * @package TildBJ\Seeder\Tests\Functional\Seeder
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
        $this->factory->make('fe_groups', 2)->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set([
                'title' => 'Group',
                'subgroup' => $this->call(SubGroup::class),
            ]);
        });
    }
}
