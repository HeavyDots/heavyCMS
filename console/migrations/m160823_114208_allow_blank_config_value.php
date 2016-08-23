<?php

use yii\db\Migration;

class m160823_114208_allow_blank_config_value extends Migration
{
    public function up()
    {
      $this->execute("ALTER TABLE `global_configuration` CHANGE `value` `value` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    }

    public function down()
    {
        echo "m160823_114208_allow_blank_config_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
