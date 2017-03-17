<?php

namespace humhub\modules\places\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[PlaceStatus]].
 *
 * @see PlaceStatus
 */
class PlaceStatusQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PlaceStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PlaceStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
