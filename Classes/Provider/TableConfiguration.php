<?php
namespace Dennis\Seeder\Provider;

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
use Dennis\Seeder\Traits;

/**
 * TableConfiguration
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TableConfiguration
{
    use Traits\Language;

    /**
     * extensionConfiguration
     *
     * @var array $tableConfiguration
     */
    protected $tableConfiguration;

    /**
     * table
     *
     * @var string $table
     */
    protected $table;

    /**
     * ExtensionConfigurationUtility constructor.
     *
     * @param $table
     */
    public function __construct($table)
    {
        if (!isset($GLOBALS['TCA'][$table])) {
            throw new \InvalidArgumentException(
                'Configuration for table ' . $table . ' not found!'
            );
        }
        $this->table = $table;
        $this->tableConfiguration = $GLOBALS['TCA'][$table];
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->table;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->translate($this->tableConfiguration['ctrl']['title']);
    }

    /**
     * getColumns
     *
     * @return array
     */
    public function getColumns()
    {
        return array_keys($this->tableConfiguration['columns']);
    }

    /**
     * getColumnConfiguration
     *
     * @param $column
     * @return array
     */
    public function getColumnConfiguration($column)
    {
        if (!isset($this->tableConfiguration['columns'][$column])) {
            throw new \InvalidArgumentException(
                'Column ' . $column . ' does not exist for table ' . $this->table
            );
        }

        return $this->tableConfiguration['columns'][$column]['config'];
    }

    /**
     * @return array
     */
    public function getAllTables()
    {
        $tables = array();
        foreach (array_keys($GLOBALS['TCA']) as $tableName) {
            $tables[$tableName] = $tableName;
        }
        return $tables;
    }
}
