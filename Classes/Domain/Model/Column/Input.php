<?php
namespace TildBJ\Seeder\Domain\Model\Column;

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
use TildBJ\Seeder\Domain\Model\Column;

/**
 * Class Input
 *
 * @package TildBJ\Seeder\Domain\Model\Input
 */
class Input extends Column implements InputInterface
{
    /**
     * @var string
     */
    protected $max;

    /**
     * @var array
     */
    protected $range;

    /**
     * @var int
     */
    protected $size;

    /**
     * Input constructor.
     *
     * @param string $columnName
     * @param $configuration
     */
    public function __construct($columnName, $configuration)
    {
        parent::__construct($columnName);
        $this->max = $configuration['max'];
        $this->range = $configuration['range'];
        $this->size = $configuration['size'];
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return array
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
