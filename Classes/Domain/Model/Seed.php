<?php
namespace Dennis\Seeder\Domain\Model;

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
 * Seed
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Seed extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements \Dennis\Seeder\Seed
{
    /**
     * title
     *
     * @var string $title
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * target
     *
     * @var string $target
     * @validate NotEmpty
     */
    protected $target = '';

    /**
     * properties
     *
     * @var string $properties
     */
    protected $properties;

    /**
     * @var int
     */
    protected $pid = 0;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * setProperties
     *
     * @param $properties
     * @return $this
     */
    public function setProperties(array $properties)
    {
        $this->properties = serialize($properties);

        return $this;
    }

    /**
     * getProperties
     *
     * @return array
     */
    public function getProperties()
    {
        return unserialize($this->properties);
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * The target, for example the table name
     *
     * @param string $target
     * @return $this
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }
}
