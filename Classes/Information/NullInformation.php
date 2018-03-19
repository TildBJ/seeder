<?php
namespace TildBJ\Seeder\Information;

/**
 * Class DefaultInformation
 *
 * @package TildBJ\Seeder\Information\DefaultInformation
 */
class NullInformation extends AbstractInformation
{
    /**
     * @return int
     */
    public function getDefaultValue()
    {
        return 0;
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
        return 0;
    }
}
