<?php

use yii\db\Migration;

class m160830_141435_simple_post_tags extends Migration
{
    public function up()
    {
      $this->execute("ALTER TABLE `blog_post_lang` ADD `tags_list` VARCHAR(255) NULL AFTER `text`;");
    }

    public function down()
    {
        echo "m160830_141435_simple_post_tags cannot be reverted.\n";

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
