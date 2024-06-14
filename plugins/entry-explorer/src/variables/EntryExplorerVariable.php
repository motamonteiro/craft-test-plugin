<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\variables;

use motamonteiro\craftentryexplorer\EntryExplorer;

class EntryExplorerVariable
{
    /**
     * Get Hello World message
     */
    public function getHelloWorldMessage(): string
    {
        return EntryExplorer::$plugin->entryExplorer->getHelloWorldMessage();
    }
}
