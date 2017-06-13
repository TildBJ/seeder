<?php
namespace Dennis\Seeder\Collection;

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

use Dennis\Seeder\Seed;
use Dennis\Seeder\Seeder;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * SeedCollection
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeedCollection implements \Dennis\Seeder\SeedCollection, \Iterator, \Countable, SingletonInterface
{
    /**
     * seeds
     *
     * @var array $seeds
     */
    protected $seeds = [];

    /**
     * Used Keys
     *
     * @var array
     */
    protected $used = [];

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
     * @param Seeder $seed
     * @return array
     */
    public function get(Seeder $seed)
    {
        $return = [];
        foreach ($this->seeds as $key => $seeds) {
            foreach ($seeds as $title => $test) {
                if ($title === get_class($seed)) {
                    if ($this->isUsed($key)) {
                        continue;
                    }
                    $this->used[$key] = 1;
                    $return[$key] = $test;
                }
            }
        }

        return $return;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isUsed($key)
    {
        return isset($this->used[$key]);
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
            $function($seed, \Dennis\Seeder\Factory\FakerFactory::createFaker());
        }

        return $this;
    }

    /**
     * @param Seed $seed
     * @throws \Exception
     */
    public function attach(Seed $seed)
    {
        $this->seeds[$seed->getTitle()]['NEW' . ++$this->i] = $seed;
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
     * @return void
     */
    public function clear()
    {
        $this->seeds = [];
    }
}
