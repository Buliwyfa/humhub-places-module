<?php

namespace humhub\modules\places\models;

/**
 * This is the model class for table "place_gps".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $gps
 */
class PlaceGps extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_gps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'gps'], 'required'],
            [['place_id'], 'integer'],
            [['gps'], 'safe'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'gps' => 'Gps',
        ];
    }

    /**
     * @inheritdoc
     * @return PlaceGpsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceGpsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['place_id' => 'id']);
    }
}
