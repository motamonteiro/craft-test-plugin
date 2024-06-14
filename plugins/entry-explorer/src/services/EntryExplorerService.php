<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\services;

use Craft;
use craft\base\Component;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use motamonteiro\craftentryexplorer\models\EntryExplorerModel;
use motamonteiro\craftentryexplorer\records\EntryExplorerRecord;

/**
 * @property EntryQuery $entries
 */
class EntryExplorerService extends Component
{
    /**
     * Returns processed entries
     */
    public function getEntries(): EntryQuery
    {
        // Get all records from DB ordered by entryId ascending
        /** @var EntryExplorerRecord[] $entryExplorerRecords */
        $entryExplorerRecords = EntryExplorerRecord::find()
            ->orderBy('entryId asc')
            ->all();

        // Get entry ids from records
        $entryIds = [];

        foreach ($entryExplorerRecords as $entryExplorerRecord) {
            $entryIds[] = $entryExplorerRecord->entryId;
        }

        // Return entry query
        return Entry::find()
            ->id($entryIds)
            ->fixedOrder();
    }

    /**
     * Returns Entry Explorer Fields
     */
    public function getEntryExplorerFields(int $entryId): EntryExplorerModel
    {
        // Create new model
        $entryExplorerModel = new EntryExplorerModel();

        // Get record from database
        $entryExplorerRecord = EntryExplorerRecord::find()
            ->where(['entryId' => $entryId])
            ->one();

        if ($entryExplorerRecord) {
            // populate model from record
            $entryExplorerModel->hasEmptyFields = $entryExplorerRecord->hasEmptyFields;
        }

        // Return
        return $entryExplorerModel;
    }
}
