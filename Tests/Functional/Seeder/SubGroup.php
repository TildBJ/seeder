<?php
namespace Dennis\Seeder\Tests\Functional\Seeder;

use Dennis\Seeder;

/**
 * Class User
 * @package Dennis\Seeder\Seeder
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
        $this->factory->create('fe_groups', 1)->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set([
                'title' => 'SubGroup',
            ]);
        });
    }
}
