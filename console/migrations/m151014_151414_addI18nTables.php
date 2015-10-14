<?php

use yii\db\Schema;
use yii\db\Migration;

class m151014_151414_addI18nTables extends Migration
{
    /**
     * @return bool|void
     * @throws InvalidConfigException
     */
    public function safeUp()
    {
        $sourceMessageTable = '{{%source_message}}';
        $messageTable = '{{%translated_message}}';
        $this->createTable($sourceMessageTable, [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_STRING,
            'message' => Schema::TYPE_TEXT
        ]);
        $this->createTable($messageTable, [
            'id' => Schema::TYPE_INTEGER,
            'language' => Schema::TYPE_STRING,
            'translation' => Schema::TYPE_TEXT
        ]);
        $this->addPrimaryKey('id', $messageTable, ['id', 'language']);
        $this->addForeignKey('fk_source_message_message', $messageTable, 'id', $sourceMessageTable, 'id', 'cascade', 'restrict');
    }
    public function safeDown()
    {
        $i18n = Yii::$app->getI18n();
        if (!isset($i18n->sourceMessageTable) || !isset($i18n->messageTable)) {
            throw new InvalidConfigException('You should configure i18n component');
        }
        $this->dropTable($i18n->sourceMessageTable);
        $this->dropTable($i18n->messageTable);
        return true;
    }
}
