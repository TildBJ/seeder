<?php
namespace Dennis\Seeder\Utility;

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

/**
 * Class Dependency
 *
 * @package Dennis\Seeder\Utility
 * Dennis\Seeder\Utility;
 */
class Dependency
{
    /**
     * checkDependencies
     *
     * @return bool
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\NoSuchFileException
     */
    public static function checkDependencies()
    {
        return self::fakerCanBeLoaded();
    }

    /**
     * fakerCanBeLoaded
     *
     * @return bool
     */
    protected static function fakerCanBeLoaded()
    {
        if (!is_file(self::getFakerAutoloadPath())) {
            return false;
        }

        return true;
    }

    /**
     * getFakerAutoloadPath
     *
     * @return string
     */
    public static function getFakerAutoloadPath()
    {
        /** @var EmConfiguration $emConfiguration */
        $emConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(EmConfiguration::class);

        return PATH_site . $emConfiguration->pathToFaker . 'src/autoload.php';
    }
}
