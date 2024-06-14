<?php

namespace motamonteiro\craftentryexplorer\migrations;

use Craft;
use craft\db\Migration;
use motamonteiro\craftentryexplorer\records\EntryExplorerRecord;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        if (!$this->db->tableExists(EntryExplorerRecord::tableName())) {
            $this->createTable(EntryExplorerRecord::tableName(), [
                'id' => $this->primaryKey(),
                'message' => $this->string()->notNull(),
                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid' => $this->uid(),
            ]);

            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(EntryExplorerRecord::tableName());

        return true;
    }
}
