<?php

namespace humhub\modules\places\models;

use humhub\models\ModuleEnabled;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $name
 * @property string $module_id
 * @property string $location
 * @property integer $created_by
 * @property string $category
 *
 * @property ModuleEnabled $module
 * @property User $createdBy
 */
class Place extends \rezaid\geopoint\ActiveRecord
{
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
            [['name', 'module_id', 'location', 'created_by'], 'required'],
            [['location'], 'string'],
            [['created_by'], 'integer'],
            [['name', 'module_id', 'category'], 'string', 'max' => 125],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleEnabled::className(), 'targetAttribute' => ['module_id' => 'module_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'module_id' => 'Module ID',
            'location' => 'Location',
            'created_by' => 'Created By',
            'category' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModuleEnabled::className(), ['module_id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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
