<?php
namespace Dennis\Seeder\Domain\Model;

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
use Dennis\Seeder\Provider\TableConfiguration;

/**
 * Class Table
 *
 * @package Dennis\Seeder\Domain\Model\Table
 */
class Table implements TableInterface
{
    /**
     * @var array
     */
    protected $columns;

    /**
     * @var string
     */
    protected $name;

    /**
     * Table constructor.
     *
     * @param TableConfiguration $tableConfiguration
     */
    public function __construct(TableConfiguration $tableConfiguration)
    {
        foreach ($tableConfiguration->getColumns() as $columnName) {
            $this->columns[] = \Dennis\Seeder\Factory\Column::getInstance(
                $tableConfiguration->getName(),
                $tableConfiguration->getColumnConfiguration($columnName)
            );
        }
        $this->name = $tableConfiguration->getName();
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
