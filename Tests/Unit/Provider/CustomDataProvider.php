<?php

namespace Dennis\Seeder\Tests\Unit\Provider;

/**
 * Class CustomDataProvider
 *
 * @package Dennis\Seeder\Tests\Unit\Provider
 */
class CustomDataProvider implements \Dennis\Seeder\Provider
{
    /**
     * @return string
     */
    public function generate()
    {
        return 'customData';
    }
}
