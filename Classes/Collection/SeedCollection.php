<?php
namespace TildBJ\Seeder\Collection;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

use TildBJ\Seeder\Seed;
use TildBJ\Seeder\Seeder;

/**
 * SeedCollection
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeedCollection implements \TildBJ\Seeder\SeedCollection
{
    /**
     * seeds
     *
     * @var array $seeds
     */
    protected $seeds = [];

    /**
     * @var array $temp
     */
    protected $temp = [];

    /**
     * @var int
     */
    protected $i = 0;

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];

        /** @var Seed $seed */
        foreach ($this->seeds as $seeds) {
            foreach ($seeds as $key => $seed) {
                $return[$seed->getTarget()][$key] = $seed->getProperties();
            }
        }

        return $return;
    }

    /**
     * @param Seeder $seeder
     * @return array
     */
    public function get(Seeder $seeder)
    {
        if (isset($this->temp[$seeder->getClass()])) {
            $return = $this->temp[$seeder->getClass()];
            unset($this->temp[$seeder->getClass()]);
            return $return;
        }
        $return = [];
        foreach ($this->seeds as $title => $seeds) {
            foreach ($seeds as $key => $seed) {
                if ($title === $seeder->getClass()) {
                    $return[$key] = $seed;
                }
            }
        }

        return $return;
    }

    /**
     * each
     *
     * @param callable $function
     * @return $this
     */
    public function each(callable $function)
    {
        $reflection = new \ReflectionFunction($function);
        $className = get_class($reflection->getClosureThis());
        foreach ($this->seeds[$className] as $key => $seed) {
            if ($seed->isExecuted()) {
                continue;
            }
            $seed->isExecuted(true);
            $function($seed, \TildBJ\Seeder\Factory\FakerFactory::createFaker());
        }

        return $this;
    }

    /**
     * @param Seed $seed
     * @throws \Exception
     */
    public function attach(Seed $seed)
    {
        $identifier = 'NEW' . ++$this->i;
        $this->seeds[$seed->getTitle()][$identifier] = $seed;
        $this->temp[$seed->getTitle()][$identifier] = $identifier;
    }

    /**
     * Returns a random seed. Returns null if there is no seed or there are less seeds than you want to create
     * In this case you may $this->attach a new Seed.
     *
     * @param string $className
     * @return Seed
     */
    public function random($className, $i)
    {
        if (!isset($this->seeds[$className]) || count($this->seeds[$className]) < $i) {
            return null;
        }
        $random = array_rand($this->seeds[$className]);
        return $this->seeds[$className][$random];
    }

    /**
     * detach
     *
     * @param string $key
     * @return void
     */
    public function detach($key)
    {
        if (isset($this->seeds[$key])) {
            unset($this->seeds[$key]);
        }
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return current($this->seeds) !== false;
    }

    /**
     * Return the current element
     *
     * @return Seed
     */
    public function current()
    {
        return current($this->seeds);
    }

    /**
     * Move forward to next element
     *
     * @return Seed
     */
    public function next()
    {
        return next($this->seeds);
    }

    /**
     * Return the key of the current element
     *
     * @return Seed
     */
    public function key()
    {
        return key($this->seeds);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return Seed
     */
    public function rewind()
    {
        return reset($this->seeds);
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count()
    {
        return count($this->seeds);
    }

    /**
     * @param string $name
     * @return int
     */
    public function countByName($name)
    {
        if (!is_array($this->seeds[$name])) {
            return 0;
        }
        return count($this->seeds[$name]);
    }

    /**
     * @return void
     */
    public function clear()
    {
        $this->seeds = [];
        $this->i = 0;
    }
}
