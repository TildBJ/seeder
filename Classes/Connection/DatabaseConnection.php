<?php

namespace TildBJ\Seeder\Connection;

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
use TildBJ\Seeder\Connection;
use TildBJ\Seeder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * DatabaseConnection
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class DatabaseConnection implements Connection
{
    /**
     * fetch
     *
     * @param array $seedArray
     * @throws Seeder\Exception
     * @return bool
     */
    public function fetch(array $seedArray)
    {
        /** @var \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\DataHandler::class);
        $GLOBALS['BE_USER']->user['admin'] = true;
        $dataHandler->start($seedArray, '');
        $dataHandler->process_datamap();
        $dataHandler->clear_cacheCmd('pages');

        return true;
    }
}
