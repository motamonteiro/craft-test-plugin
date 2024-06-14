<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\records;

use craft\db\ActiveRecord;

/**
 * @property int $id
 * @property string $message
 */
class EntryExplorerRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%entryexplorer}}';
    }
}
