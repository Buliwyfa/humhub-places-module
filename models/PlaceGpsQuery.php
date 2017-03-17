<?php

namespace humhub\modules\places\models;

/**
 * This is the ActiveQuery class for [[PlaceGps]].
 *
 * @see PlaceGps
 */
class PlaceGpsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PlaceGps[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PlaceGps|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
