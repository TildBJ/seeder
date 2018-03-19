<?php
namespace Dennis\Seeder;

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

/**
 * SeedCollection
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface SeedCollection extends \Iterator, \Countable, \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * each
     *
     * @param callable $function
     * @return $this
     */
    public function each(callable $function);

    /**
     * attach
     *
     * @param Seed $seed
     * @return void
     */
    public function attach(Seed $seed);

    /**
     * detach
     *
     * @param string $key
     * @return void
     */
    public function detach($key);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param Seeder $seeder
     * @return array
     */
    public function get(Seeder $seeder);

    /**
     * @param string $name
     * @return int
     */
    public function countByName($name);

    /**
     * @return void
     */
    public function clear();
}
