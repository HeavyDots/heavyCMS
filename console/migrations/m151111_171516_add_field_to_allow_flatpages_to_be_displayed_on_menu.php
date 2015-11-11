<?php

use yii\db\Schema;
use yii\db\Migration;

class m151111_171516_add_field_to_allow_flatpages_to_be_displayed_on_menu extends Migration
{
    public function up()
    {
        $this->execute("
            ALTER TABLE `flat_page`
            ADD `display_on_menu` tinyint(1) NOT NULL DEFAULT '1' AFTER `is_active`;
        ");
    }

    public function down()
    {
        echo "m151111_171516_add_field_to_allow_flatpages_to_be_displayed_on_menu cannot be reverted.\n";

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
