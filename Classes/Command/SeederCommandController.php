<?php
namespace Dennis\Seeder\Command;

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

use Dennis\Seeder\Domain\Model\ColumnInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SeederCommandController
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeederCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{
    /**
     * namespace
     *
     * @var string $namespace
     */
    protected $namespace = 'Dennis\Seeder\Seeder';

    /**
     * path
     *
     * @var string $path
     */
    protected $path = 'seeder/Classes/Seeder/';

    /**
     * stub
     *
     * @var string $stub
     */
    protected $stub = 'seeder/Classes/Seeder/stubs/seeder.stub';

    /**
     * This command allows you to run predifined Seeds
     *
     * @param string $className
     * @return boolean
     */
    public function seedCommand($className)
    {
        $class = $this->namespace . '\\' . $className;

        if (!class_exists($class)) {
            $this->output->outputLine('<error>Class ' . $class . ' does not exist.</error>');
            return false;
        }

        /** @var \Dennis\Seeder\Seeder $seeder */
        $seeder = new $class;
        $seeder->run();
        $seeder->seed();

        return true;
    }

    /**
     * @param $tableName
     * @return array
     * @throws \Exception
     */
    protected function detectSeederInformations($tableName)
    {
        $informations = [];
        $faker = \Dennis\Seeder\Factory\FakerFactory::createFaker();

        $table = \Dennis\Seeder\Factory\TableFactory::createTable($tableName);

        $skippingFields = [
            'l10n_parent',
            'l10n_diffsource',
            'cruser_id',
            'TSconfig',
            'tx_extbase_type',
            'felogin_redirectPid',
            't3ver_label',
        ];
        /** @var ColumnInterface $column */
        foreach ($table->getColumns() as $column) {
            if (in_array($column->getName(), $skippingFields)) {
                continue;
            }
            $provider = $faker->guessProvider($column->getName());
            $informationClassName = 'Dennis\\Seeder\\Information\\' . ucfirst(GeneralUtility::underscoredToLowerCamelCase($column->getName()) . 'Information');
            $relationInformationAvailable = false;
            if (class_exists($informationClassName)) {
                $information = GeneralUtility::makeInstance($informationClassName);
            } elseif ($this->isRelation($column)) {
                $information = GeneralUtility::makeInstance(\Dennis\Seeder\Information\RelationInformation::class);
                $relationInformationAvailable = true;
            } else {
                $information = GeneralUtility::makeInstance(\Dennis\Seeder\Information\DefaultInformation::class);
                $information->setDefaultValue($provider);
            }
            if (!$information instanceof \Dennis\Seeder\Information) {
                throw new \Exception($informationClassName . ' must implement ' . \Dennis\Seeder\Information::class);
            }

            if ($this->isRelation($column) && $relationInformationAvailable) {
                $createNewSeeder = $this->askOrSelect($information->getQuestion([$column->getName()]), 'n');
                if (strtolower($createNewSeeder) === 'y' || strtolower($createNewSeeder) === 'yes' || $createNewSeeder == 1) {
                    $className = '';
                    while (!$className) {
                        $className = $this->output->ask('<fg=yellow>Please specify the required argument "--class-name" (<fg=green>' . $column->getForeignTable() . '</>):</> ');
                    }
                    $this->makeCommand($className, $column->getForeignTable());
                    $informations[$column->getName()] = '$this->call(' . $className . '::class)';
                }
            } else {
                switch ($information->getType()) {
                    case \Dennis\Seeder\Information::INFORMATION_TYPE_ASK:
                        if (!is_null($response = $this->askOrSelect($information->getQuestion([$column->getName(), $provider]), $information->getDefaultValue()))) {
                            try {
                                $informations[$column->getName()] = '$faker->get' . ucfirst($faker->getProviderNameByKey($response)) . '()';
                            } catch (\TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException $e) {
                                $informations[$column->getName()] = $response;
                            }
                        }
                        break;
                    case \Dennis\Seeder\Information::INFORMATION_TYPE_SELECT:
                    case \Dennis\Seeder\Information::INFORMATION_TYPE_SELECTMULTIPLE:
                        if (!is_null($response = $this->askOrSelect($information->getQuestion([$column->getName(), $provider]), $information->getDefaultValue(), $information->getChoices()))) {
                            try {
                                $informations[$column->getName()] = '$faker->get' . ucfirst($faker->getProviderNameByKey($response)) . '()';
                            } catch (\TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException $e) {
                                $informations[$column->getName()] = $response;
                            }
                        }
                        break;
                }
            }
        }

        return $informations;
    }

    /**
     * @param ColumnInterface $column
     * @return bool
     */
    protected function isRelation(ColumnInterface $column)
    {
        return (
        (
            $column instanceof \Dennis\Seeder\Domain\Model\Column\Select ||
            $column instanceof \Dennis\Seeder\Domain\Model\Column\Inline ||
            $column instanceof \Dennis\Seeder\Domain\Model\Column\Group
        ) &&
            $column->getForeignTable()
        );
    }

    /**
     * @param $question
     * @param $defaultValue
     * @param null $choices
     * @return array|int|string
     */
    protected function askOrSelect($question, $defaultValue, $choices = null)
    {
        if (is_null($choices)) {
            return $this->output->ask($question, $defaultValue);
        }
        return $this->output->select($question, $choices, $defaultValue);
    }

    /**
     * This command allows you to create new Seeds.
     *
     * @param string $className
     * @param string $tableName
     * @return boolean
     */
    public function makeCommand($className, $tableName)
    {
        $class = $this->namespace . '\\' . $className;

        if (class_exists($class)) {
            $this->output->outputLine('<error>Class ' . $class . ' already exists.</error>');
            return false;
        }

        if (!isset($GLOBALS['TCA'][$tableName])) {
            $this->outputAndExit('Configuration for ' . $tableName . ' not Found!');
        }
        $informations = $this->detectSeederInformations($tableName);

        $seederClass = $this->getSeederClass($this->namespace, $className, $tableName, $informations);
        $file = fopen(__DIR__ . '/../../../' . $this->path . $className . '.php', 'w');
        fwrite($file, $seederClass);
        fclose($file);

        $this->output->outputLine(
            '<fg=green>' . __DIR__ . '/../../../' . $this->path . $className . '.php' . ' successfully created</>'
        );

        return true;
    }

    /**
     * @param $string
     */
    protected function outputAndExit($string)
    {
        $this->output->outputLine('<error> ' . $string . ' </error>');
        exit;
    }

    /**
     * getSeederClass
     *
     * @param string $namespace
     * @param string $className
     * @param array $informations
     * @return string
     */
    protected function getSeederClass($namespace, $className, $tableName, $informations)
    {
        $stub = file_get_contents(__DIR__ . '/../../../' . $this->stub);

        $stub = str_replace('{namespace}', $namespace, $stub);
        $stub = str_replace('{ClassName}', $className, $stub);
        $stub = str_replace('{TableName}', $tableName, $stub);
        $informations = var_export($informations, true);
        $pattern = '/(\'.*\'\s=>\s)\'(\$.+->\w+\(.*\))\'/';
        $replacement = '${1}${2}';
        $informations = preg_replace($pattern, $replacement, $informations);
        $stub = str_replace('{informations}', $informations, $stub);

        return $stub;
    }
}
