<?php
namespace Dennis\Seeder;

/**
 * Interface Generator
 *
 * @package Dennis\Seeder\Information
 */
interface Generator
{
    const PREFIX = '$faker->get';
    const SUFFIX = '()';

    /**
     * @return mixed
     */
    public function generate($parameter);
}
