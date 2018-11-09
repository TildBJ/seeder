<?php
namespace TildBJ\Seeder\Factory;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class FakerFactory
 *
 * @package TildBJ\Seeder\Factory\TableFactory
 */
class FakerFactory
{
    /**
     * instance
     *
     * @var \TildBJ\Seeder\Provider\Faker $instance
     */
    protected static $instance = null;

    /**
     * @codeCoverageIgnore
     */
    protected function __construct()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    protected function __clone()
    {
    }

    /**
     * Provides a Faker
     *
     * @return \TildBJ\Seeder\Provider\Faker
     */
    public static function createFaker()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        }

        $locale = \TildBJ\Seeder\Utility\EmConfiguration::get('locale');
        if (!$locale) {
            $locale = 'en_US';
        }
        $faker = new \TildBJ\Seeder\Provider\Faker(\Faker\Factory::create($locale));

        self::$instance = $faker;

        return $faker;
    }
}
