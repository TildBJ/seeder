<?php
namespace Dennis\Seeder\Factory;

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
use Dennis\Seeder\Provider\TableConfiguration;
use Dennis\Seeder\Domain\Model;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TableFactory
 *
 * @package Dennis\Seeder\Factory\TableFactory
 */
class TableFactory implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var array $tables
     */
    protected static $tables = [];

    /**
     * @var array $columns
     */
    protected static $columns = [];

    /**
     * Provides a Table
     *
     * @param string $tableName
     * @return Model\TableInterface
     */
    public static function createTable($tableName)
    {
        /** @var TableConfiguration $tableConfiguration */
        $tableConfiguration = GeneralUtility::makeInstance(TableConfiguration::class, $tableName);
        if (!in_array($tableName, self::$tables)) {
            self::$tables[$tableName] = new Model\Table($tableConfiguration);
        }

        return self::$tables[$tableName];
    }

    /**
     * createColumn
     *
     * @param string $tableName
     * @param array $columnName
     * @return Model\ColumnInterface
     */
    public static function createColumn($tableName, $columnName)
    {
        $tableConfiguration = new TableConfiguration($tableName);
        $columnConfiguration = $tableConfiguration->getColumnConfiguration($columnName);
        $key = $tableName . '.' . key($columnConfiguration);
        if (!in_array($key, self::$columns)) {
            self::$columns[$key] = self::getColumn($columnName, $columnConfiguration[key($columnConfiguration)]);
        }

        return self::$columns[$key];
    }

    /**
     * @param string $columnName
     * @param array $configuration
     * @return Model\ColumnInterface
     */
    protected static function getColumn($columnName, $configuration)
    {
        $column = null;
        switch ($configuration['type']) {
            case 'input':
                $column = new Model\Column\Input($columnName, $configuration);
                break;
            case 'text':
                $column = new Model\Column\Text($columnName, $configuration);
                break;
            case 'check':
                $column = new Model\Column\Check($columnName, $configuration);
                break;
            case 'radio':
                $column = new Model\Column\Radio($columnName, $configuration);
                break;
            case 'select':
                $column = new Model\Column\Select($columnName, $configuration);
                break;
            case 'group':
                $column = new Model\Column\Group($columnName, $configuration);
                break;
            case 'none':
                $column = new Model\Column\None($columnName, $configuration);
                break;
            case 'inline':
                $column = new Model\Column\Inline($columnName, $configuration);
                break;
            case 'passthrough':
            case 'user':
            case 'flex':
            default:
                $column = new Model\Column\None($columnName, $configuration);
        }

        return $column;
    }
}
