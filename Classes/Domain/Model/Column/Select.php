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
 * Class Select
 *
 * @package TildBJ\Seeder\Domain\Model\Group
 */
class Select extends Column implements SelectInterface
{
    /**
     * @return string
     */
    protected $foreignTable;

    /**
     * @return string
     */
    protected $foreignTableWhere;

    /**
     * @return array
     */
    protected $items;

    /**
     * @return int
     */
    protected $maxItems;

    /**
     * @return int
     */
    protected $minItems;

    /**
     * @return int
     */
    protected $size;

    /*
     * @var string
     */
    protected $foreignField;

    /**
     * Input constructor.
     *
     * @param string $columnName
     * @param $configuration
     */
    public function __construct($columnName, $configuration)
    {
        parent::__construct($columnName);
        $this->foreignTable = $configuration['foreign_table'];
        $this->foreignField = $configuration['foreign_field'];
        $this->foreignTableWhere = $configuration['foreign_table_where'];
        $this->items = $configuration['items'];
        $this->maxItems = $configuration['maxitems'];
        $this->minItems = $configuration['minitems'];
        $this->size = $configuration['size'];
    }

    /**
     * @return string
     */
    public function getForeignTable()
    {
        return $this->foreignTable;
    }

    /**
     * @return string
     */
    public function getForeignTableWhere()
    {
        return $this->foreignTableWhere;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getMaxItems()
    {
        return $this->maxItems;
    }

    /**
     * @return int
     */
    public function getMinItems()
    {
        return $this->minItems;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    public function getForeignField()
    {
        return $this->foreignField;
    }
}
