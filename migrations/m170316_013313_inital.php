<?php

use humhub\modules\user\models\ProfileField;
use yii\db\Migration;

class m170316_013313_inital extends Migration
{
    public function up()
    {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(125)->notNull(),
            'module_id' => $this->string(125)->notNull(),
            'location' => 'POINT NOT NULL',
            'created_by' => $this->integer(11)->notNull(),
            'category' => $this->string(125),
        ]);
        $this->createIndex('User', 'place', ['created_by', 'module_id']);
        $this->addForeignKey('place_fk_user', 'place', 'created_by', 'user', 'id');
        $this->addForeignKey('place_fk_module_id', 'place', 'module_id', 'module_enabled', 'module_id');

        if ($this->db->driverName === 'mysql') {
            $this->execute('CREATE SPATIAL INDEX `idx-place-location` ON '.'{{%place}}(location);');
        } elseif ($this->db->driverName === 'pgsql') {
            $this->execute('CREATE INDEX "idx-place-location" ON '.'{{%place}} USING GIST(location);');
        }

        $fieldNames = ['street', 'zip', 'city', 'state'];
        $this->updateProfileField($fieldNames);

    }


    public function updateProfileField(array $fieldNames)
    {
        foreach ($fieldNames as $fieldName) {
            $field = ProfileField::find()->where(['internal_name' => $fieldName])->one();
            $field->show_at_registration = 1;
            $field->save();
        }
    }

    public function down()
    {
        echo "m170314_174103_inital cannot be reverted.\n";

        return false;
    }
}