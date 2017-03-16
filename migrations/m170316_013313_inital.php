<?php

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

        if ($this->db->driverName === 'mysql') {
            $this->execute('CREATE SPATIAL INDEX `idx-place-location` ON '.'{{%place}}(location);');
        } elseif ($this->db->driverName === 'pgsql') {
            $this->execute('CREATE INDEX "idx-place-location" ON '.'{{%place}} USING GIST(location);');
        }

    }
}