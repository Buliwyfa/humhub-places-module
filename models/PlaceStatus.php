<?php

namespace humhub\modules\places\models;

/**
 * This is the model class for table "place_status".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $status
 *
 * @property Place[] $places
 */
class PlaceStatus extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlaceType::className(), 'targetAttribute' => ['id' => 'type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PlaceStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceStatusQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PlaceType::className(), ['id' => 'type_id']);
    }
}
