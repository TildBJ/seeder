<?php
namespace TildBJ\Seeder;

/**
 * Interface Generator
 *
 * @package TildBJ\Seeder\Information
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
