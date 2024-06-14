<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\variables;

use motamonteiro\craftentryexplorer\EntryExplorer;
use motamonteiro\craftentryexplorer\models\EntryExplorerModel;

class EntryExplorerVariable
{
    /**
     * Get Hello World message
     */
    public function getHelloWorldMessage(): EntryExplorerModel
    {
        return EntryExplorer::$plugin->entryExplorer->getHelloWorldMessage();
    }

    /**
     * Add Hello World message
     */
    public function addHelloWorldMessage(string $message): EntryExplorerModel
    {
        return EntryExplorer::$plugin->entryExplorer->addHelloWorldMessage($message);
    }
}
