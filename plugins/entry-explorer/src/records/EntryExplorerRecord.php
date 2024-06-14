<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\records;

use craft\db\ActiveRecord;

/**
 * @property int $id
 * @property int $entryId
 * @property bool $hasEmptyFields
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
