<?php
namespace Dennis\Seeder\Information;

/**
 * Class DefaultInformation
 *
 * @package Dennis\Seeder\Information\DefaultInformation
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
