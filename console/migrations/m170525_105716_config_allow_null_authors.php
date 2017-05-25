<?php

use yii\db\Migration;

class m170525_105716_config_allow_null_authors extends Migration
{
    public function up()
    {
      
      $this->execute("ALTER TABLE `global_configuration` CHANGE `created_by` `created_by` INT(11) NULL, CHANGE `updated_by` `updated_by` INT(11) NULL;");

    }

    public function down()
    {
        echo "m170525_105716_config_allow_null_authors cannot be reverted.\n";

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
