<?php

namespace humhub\modules\places\models;

/**
 * This is the model class for table "place_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Place[] $places
 */
class PlaceType extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PlaceTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceTypeQuery(get_called_class());
    }
}
