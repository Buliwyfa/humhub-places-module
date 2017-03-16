<?php

namespace humhub\modules\places\models;

use rezaid\geopoint\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Place]].
 *
 * @see Place
 */
class PlaceQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Place[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Place|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
