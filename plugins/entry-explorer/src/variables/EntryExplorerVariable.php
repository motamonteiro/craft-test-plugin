<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\variables;

use craft\elements\db\EntryQuery;
use motamonteiro\craftentryexplorer\EntryExplorer;
use motamonteiro\craftentryexplorer\models\EntryExplorerModel;

class EntryExplorerVariable
{
    /**
     * Returns processed entries
     */
    public function getEntries(): EntryQuery
    {
        return EntryExplorer::$plugin->entryExplorer->getEntries();
    }

    /**
     * Returns Entry Explorer Fields
     */
    public function getEntryExplorerFields(int $entryId): EntryExplorerModel
    {
        return EntryExplorer::$plugin->entryExplorer->getEntryExplorerFields($entryId);
    }
}
