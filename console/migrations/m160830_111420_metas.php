<?php

use yii\db\Migration;

class m160830_111420_metas extends Migration
{
    public function up()
    {
      $this->execute("
        ALTER TABLE `blog_post_lang` 
          ADD `meta_title` VARCHAR(255) NULL AFTER `slug`;  
        ALTER TABLE `blog_post_lang` 
          CHANGE `meta_description` `meta_description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
        ALTER TABLE `blog_post_lang` 
          CHANGE `text` `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
        ALTER TABLE `flat_page_lang` ADD `meta_title` VARCHAR(255) NULL AFTER `slug`;
        UPDATE `flat_page_lang` SET `meta_title`=`title`;
        ALTER TABLE `flat_page_lang` DROP `title`;
      ");
    }

    public function down()
    {
        echo "m160830_111420_metas cannot be reverted.\n";

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
