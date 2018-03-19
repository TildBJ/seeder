<?php
namespace TildBJ\Seeder\Utility;

use TYPO3\CMS\Extbase\Mvc\Cli\ConsoleOutput;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Dennis Römmich <dennis@roemmich.eu>
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

/**
 * Class OutputUtility
 *
 * @package Sunzinet\XmlExport\Utility
 */
class OutputUtility implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * output
     *
     * @var ConsoleOutput $output
     */
    protected $output;

    /**
     * OutputUtility constructor.
     */
    public function __construct()
    {
        $this->output = GeneralUtility::makeInstance(ConsoleOutput::class);
    }

    /**
     * log
     *
     * @param string $message
     */
    public function log($message)
    {
        $this->output->outputLine($message);
    }

    /**
     * @param string $message
     */
    public function error($message)
    {
        $this->log('<fg=red>' . $message . '</>');
    }

    /**
     * @param string $message
     */
    public function warning($message)
    {
        $this->log('<fg=yellow>' . $message . '</>');
    }

    /**
     * @param string $message
     */
    public function success($message)
    {
        $this->log('<fg=green>' . $message . '</>');
    }

    /**
     * @param string $message
     */
    public function info($message)
    {
        $this->log('<fg=blue>' . $message . '</>');
    }

    /**
     * @param $question
     * @param null $default
     * @param array|null $autocomplete
     * @return string
     */
    public function ask($question, $default = null, array $autocomplete = null)
    {
        return $this->output->ask($question, $default, $autocomplete);
    }

    /**
     * @param $question
     * @param $choices
     * @param null $default
     * @param bool $multiSelect
     * @param bool $attempts
     * @return array|int|string
     */
    public function select($question, $choices, $default = null, $multiSelect = false, $attempts = false)
    {
        return $this->output->select($question, $choices, $default, $multiSelect, $attempts);
    }

    /**
     * @param null $max
     * @return void
     */
    public function progressStart($max = null)
    {
        $this->output->progressStart($max);
    }

    /**
     * @param int $step
     * @param bool $redraw
     * @return void
     */
    public function progressAdvance($step = 1, $redraw = false)
    {
        $this->output->progressAdvance($step, $redraw);
    }

    /**
     * @param $current
     * @param bool $redraw
     * @return void
     */
    public function progressSet($current, $redraw = false)
    {
        $this->output->progressSet($current, $redraw);
    }

    /**
     * @return void
     */
    public function progressFinish()
    {
        $this->output->progressFinish;
    }
}
