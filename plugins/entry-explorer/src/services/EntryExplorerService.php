<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\services;

use Craft;
use craft\base\Component;
use craft\elements\db\EntryQuery;
use motamonteiro\craftentryexplorer\models\EntryExplorerModel;
use motamonteiro\craftentryexplorer\records\EntryExplorerRecord;

/**
 * @property EntryQuery $entries
 */
class EntryExplorerService extends Component
{

    /**
     * Get Hello World message
     */
    public function getHelloWorldMessage(): EntryExplorerModel
    {
        // Create a new model
        $model = new EntryExplorerModel();

        // Get all records from DB ordered by message
        $record = EntryExplorerRecord::find()
            ->orderBy(['message' => SORT_ASC])
            ->one();

        if ($record) {
            $attributes = $record->getAttributes();
            $model->setAttributes($attributes);
        }

        return $model;
    }

    /**
     * Add Hello World message
     */
    public function addHelloWorldMessage($message): EntryExplorerModel
    {
        // Create a new record and save the message
        $record = new EntryExplorerRecord();
        $record->message = $message;
        $record->save();

        // Create a new model
        $model = new EntryExplorerModel();
        $attributes = $record->getAttributes();
        $model->setAttributes($attributes);

        return $model;
    }
}
