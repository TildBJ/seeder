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

use Dennis\Seeder\Collection\SeedCollection;
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
        $seedCollection = GeneralUtility::makeInstance(SeedCollection::class);
        $seeder->before();
        $seeder->run();
        $seeder->after();
        $seeder->seed($seedCollection);

        return true;
    }

    /**
     * This command allows you to create new Seeds.
     *
     * @param string $className
     * @return boolean
     */
    public function makeCommand($className)
    {
        $class = $this->namespace . '\\' . $className;

        if (class_exists($class)) {
            $this->output->outputLine('<error>Class ' . $class . ' already exists.</error>');
            return false;
        }

        $seederClass = $this->getSeederClass($this->namespace, $className);
        $file = fopen(__DIR__ . '/../../../' . $this->path . $className . '.php', 'w');
        fwrite($file, $seederClass);
        fclose($file);

        $this->output->outputLine(
            '<fg=green>' . __DIR__ . '/../../../' . $this->path . $className . '.php' . ' successfully created</>'
        );

        return true;
    }

    /**
     * getSeederClass
     *
     * @param string $namespace
     * @param string $className
     * @return string
     */
    protected function getSeederClass($namespace, $className)
    {
        $stub = file_get_contents(__DIR__ . '/../../../' . $this->stub);

        $stub = str_replace('{namespace}', $namespace, $stub);
        $stub = str_replace('{ClassName}', $className, $stub);

        return $stub;
    }
}
