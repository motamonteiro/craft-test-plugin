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
     * Import Plugin Data
     */
    public function importPluginData(): void
    {
        EntryExplorer::$plugin->entryExplorer->importPluginData();
    }
}
