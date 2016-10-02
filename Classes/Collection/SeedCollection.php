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

/**
 * SeedCollection
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeedCollection implements \Dennis\Seeder\SeedCollection, \Iterator, \Countable
{
    /**
     * seeds
     *
     * @var array $seeds
     */
    protected $seeds = [];

    /**
     * each
     *
     * @param callable $function
     * @return $this
     */
    public function each(callable $function)
    {
        foreach ($this->seeds as $key => $seed) {
            $function($seed, \Dennis\Seeder\Factory\FakerFactory::createFaker());
        }

        return $this;
    }

    /**
     * attach
     *
     * @param Seed $seed
     * @return void
     */
    public function attach(Seed $seed)
    {
        if (!array_key_exists(spl_object_hash($seed), $this->seeds)) {
            $this->seeds[spl_object_hash($seed)] = $seed;
        }
    }

    /**
     * detach
     *
     * @param Seed $seed
     * @return void
     */
    public function detach(Seed $seed)
    {
        if (array_key_exists($seed->getTitle(), $this->seeds)) {
            unset($this->seeds[$seed->getTitle()]);
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
}
