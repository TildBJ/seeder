<?php
namespace Dennis\Seeder\Information;
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
 * Class RelationInformation
 *
 * @package Dennis\Seeder\Information\RelationInformation
 */
class RelationInformation extends AbstractInformation
{
    /**
     * @var string
     */
    protected $question = 'Seems like <fg=green>%s</> is a Relation. Would you like to create new Seeder for it? ';

    /**
     * @return string
     */
    public function getDefaultValue()
    {
        return 'N/y';
    }

    /**
     * @return array
     */
    public function getChoices()
    {
        return null;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return self::INFORMATION_TYPE_ASK;
    }
}
