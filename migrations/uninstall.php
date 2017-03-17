<?php
use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {

        $this->dropTable('{{%place_type}}');
        $this->dropTable('{{%place_status}}');
        $this->dropTable('{{%place}}');
        $this->dropTable('{{%place_gps}}');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }
}