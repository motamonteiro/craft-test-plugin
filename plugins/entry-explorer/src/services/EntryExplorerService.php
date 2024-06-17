<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\services;

use Craft;
use craft\base\Component;
use craft\elements\db\ElementQuery;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use craft\events\CancelableEvent;
use motamonteiro\craftentryexplorer\models\EntryExplorerModel;
use motamonteiro\craftentryexplorer\records\EntryExplorerRecord;

/**
 * @property EntryQuery $entries
 */
class EntryExplorerService extends Component
{
    /**
     * Returns entries to be explored
     */
    public function getEntries(): EntryQuery
    {
        $entryQuery = Entry::find();

        $entryQuery->on(ElementQuery::EVENT_BEFORE_PREPARE, function (CancelableEvent $event) {
            /** @var ElementQuery $query */
            $query = $event->sender;
            $query->addSelect(['usedFields']);
            $query->innerJoin(EntryExplorerRecord::tableName(), 'entryId = elements.id');
        });

        return $entryQuery;
    }
    public function importPluginData(): void
    {
        //Get all entries
        foreach (Entry::find()->all() ?? [] as $entry) {

            $entryExplorerRecord = EntryExplorerRecord::find()
                ->where(['entryId' => $entry->id])
                ->one();

            if (!$entryExplorerRecord) {
                $entryExplorerRecord = new EntryExplorerRecord();
            }

            $entryExplorerRecord->entryId = $entry->id;
            $entryExplorerRecord->usedFields = null;
            $entryExplorerRecord->save();

            $this->importUsedFields($entry);
        }
    }

    private function importUsedFields(Entry $entry): void
    {
        // Get record from database to save the fields data
        $entryExplorerRecord = EntryExplorerRecord::find()
            ->where(['entryId' => $entry->id])
            ->one();

        if (!$entryExplorerRecord) {
            return;
        }

        try {
            // Filter out empty fields from the entry's serialized values
            $entryFields = array_filter($entry->getSerializedFieldValues() ?? []);
        } catch (\Exception $e) {
            $entryFields = [];
        }

        // Initialize array to store used fields
        $usedFields = [];

        // Add title field if it exists and is not empty
        if (isset($entry->title) && !empty($entry->title)) {
            $usedFields[] = 'title';
        }

        // Loop through entry fields to extract field names and block types
        foreach ($entryFields as $fieldName => $fieldValue) {
            $usedFields[] = $fieldName;
        }

        $entryExplorerRecord->usedFields = implode(';', $usedFields);
        $entryExplorerRecord->save();
    }
}
