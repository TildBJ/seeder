<?php
namespace Dennis\Seeder\Provider;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis.roemmich@sunzinet.com>, sunzinet AG
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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class Faker
 *
 * @package Dennis\Seeder\Provider\Faker
 */
class Faker
{
    /** @var  $faker */
    protected $faker = null;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Returns random dummy data by property
     *
     * @param string $property
     * @return mixed
     */
    public function get($property)
    {
        $testData = call_user_func($this->guessFormat($property));

        return $testData;
    }

    /**
     * @param string $name
     * @return callable
     */
    protected function guessFormat($name)
    {
        $guesser = new \Faker\Guesser\Name($this->faker);
        $callable = $guesser->guessFormat($name);

        if (is_callable($callable)) {
            return $callable;
        }

        $name = GeneralUtility::strtolower($name);
        $faker = $this->faker;
        switch (str_replace('_', '', $name)) {
            case 'password':
                return function () use ($faker) {
                    return $faker->password(24, 24);
                };
            case 'middlename':
            case 'name':
                return function () use ($faker) {
                    return $faker->lastName;
                };
            case 'fax':
                return function () use ($faker) {
                    return $faker->phoneNumber;
                };
            case 'zip':
                return function () use ($faker) {
                    return $faker->postcode;
                };
            case 'www':
                return function () use ($faker) {
                    return $faker->url;
                };
            case 'image':
                return function () use ($faker) {
                    return $faker->imageUrl();
                };
            case 'lastlogin':
            case 'starttime':
                return function () use ($faker) {
                    return $faker->dateTime('now');
                };
            case 'endtime':
                return function () use ($faker) {
                    return $faker->dateTime('now + 2 weeks');
                };
            case 'disable':
                return function () {
                    return false;
                };
        }

        return $callable;
    }
}
