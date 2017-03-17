<?php

namespace humhub\modules\places\models;

/**
 * This is the ActiveQuery class for [[PlaceType]].
 *
 * @see PlaceType
 */
class PlaceTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PlaceType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PlaceType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
