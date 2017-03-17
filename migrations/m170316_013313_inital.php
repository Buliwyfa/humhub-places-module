<?php

use humhub\modules\user\models\ProfileField;
use yii\db\Migration;
use yii\db\Schema;

class m170316_013313_inital extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%place_type}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->insert('{{%place_type}}', ['name' => 'user residence']);

        $this->createTable('{{%place_status}}', [
            'id' => Schema::TYPE_PK,
            'type_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->addForeignKey('fk_status_type_id', '{{%place_status}}', ['type_id'], '{{%place_type}}', ['id'], 'CASCADE', 'CASCADE');
        $this->insert('{{%place_status}}', ['type_id'=> 1,'status' => 'active']);
        $this->insert('{{%place_status}}', ['type_id'=> 1,'status' => 'inactive']);



        $this->createTable('{{%place}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'type_id' => Schema::TYPE_INTEGER.' NOT NULL',
            'google_place_id' => Schema::TYPE_STRING.' NOT NULL', // e.g. google places id
            'status_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'module_id' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER .'(11) NOT NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('index_module_id', 'place', ['module_id']);
        $this->addForeignKey('fk_place_status_id', '{{%place}}', 'status_id', '{{%place_status}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_place_type_id', '{{%place}}', 'type_id', '{{%place_type}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_place_created_by', '{{%place}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');


        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%place_gps}}', [
            'id' => Schema::TYPE_PK,
            'place_id' => Schema::TYPE_SMALLINT.' NOT NULL',
            'gps'=>'POINT NOT NULL',
        ], $tableOptions);
        $this->execute('create spatial index place_gps_gps on '.'{{%place_gps}}(gps);');
        $this->createIndex('place_gps_index', '{{%place_gps}}', 'place_id');
        $this->addForeignKey('fk_place_gps','{{%place_gps}}' , 'place_id', '{{%place}}', 'id');


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