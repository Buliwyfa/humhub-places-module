<?php

namespace humhub\modules\places\models;

use humhub\components\ActiveRecord;
use humhub\modules\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_id
 * @property string $google_place_id
 * @property integer $status_id
 * @property string $module_id
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property PlaceStatus $status
 * @property PlaceType $type
 */
class Place extends ActiveRecord
{


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'status_id', 'google_place_id', 'module_id', 'created_by'], 'required'],
            [['type_id', 'status_id', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'google_place_id', 'module_id'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlaceStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlaceType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type ID',
            'google_place_id' => 'Google Place ID',
            'status_id' => 'Status ID',
            'module_id' => 'Module ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(PlaceStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PlaceType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \rezaid\geopoint\ActiveRecord
     */
    public function getGps()
    {
        return $this->hasOne(PlaceGps::className(), ['place_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PlaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceQuery(get_called_class());
    }
}
