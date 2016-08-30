<?php

use yii\db\Migration;

class m160830_110150_flat_page_allow_empty_title_and_desc extends Migration
{
    public function up()
    {
      $this->execute("
        ALTER TABLE `flat_page_lang` 
          CHANGE `title` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
          CHANGE `meta_description` `meta_description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;  
      ");
    }

    public function down()
    {
        echo "m160830_110150_flat_page_allow_empty_title_and_desc cannot be reverted.\n";

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
