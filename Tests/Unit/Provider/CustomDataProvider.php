<?php

namespace TildBJ\Seeder\Tests\Unit\Provider;

/**
 * Class CustomDataProvider
 *
 * @package TildBJ\Seeder\Tests\Unit\Provider
 */
class CustomDataProvider implements \TildBJ\Seeder\Provider
{
    /**
     * @return string
     */
    public function generate()
    {
        return 'customData';
    }
}
