<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\services;

use craft\base\Component;
use craft\elements\db\EntryQuery;

/**
 * @property EntryQuery $entries
 */
class EntryExplorerService extends Component
{

    /**
     * Get Hello World message
     */
    public function getHelloWorldMessage(): string
    {
        return "Hello World from Entry Explorer Service!";
    }
}
