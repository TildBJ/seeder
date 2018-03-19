<?php
namespace TildBJ\Seeder\Information;

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

/**
 * Class AbstractInformation
 *
 * @package TildBJ\Seeder\Information\AbstractInformation
 */
abstract class AbstractInformation implements \TildBJ\Seeder\Information
{
    /**
     * @var string
     */
    protected $question;

    /**
     * @var string
     */
    protected $defaultValue;

    /**
     * @param string $defaultValue
     * @return void
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getQuestion($params = [])
    {
        return vsprintf($this->question, $params) . ' <fg=yellow>[' . $this->getDefaultValue() . ']</>: ';
    }
}
