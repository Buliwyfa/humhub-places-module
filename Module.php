<?php
namespace humhub\modules\places;

/**
*
* @property mixed $configUrl
* @property string $name
*/
class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return ('Places');
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        return [

        ];
    }


}