<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\models;

use craft\base\Model;
use craft\validators\DateTimeValidator;
use DateTime;

class EntryExplorerModel extends Model
{
    /**
     * @var int|null
     */
    public ?int $id = null;

    /**
     * @var int|null
     */
    public ?int $entryId = null;

    /**
     * @var bool
     */
    public bool $hasEmptyFields;

    /**
     * @var DateTime|null
     */
    public ?DateTime $dateCreated = null;

    /**
     * @var DateTime|null
     */
    public ?DateTime $dateUpdated = null;

    /**
     * Define what is returned when model is converted to string
     */
    public function __toString(): string
    {
        return (string)$this->message;
    }

    public function rules(): array
    {
        $rules = parent::rules();

        $rules[] = [['entryId'], 'number'];
        $rules[] = [['hasEmptyFields'], 'boolean'];
        $rules[] = [['dateCreated', 'dateUpdated'], DateTimeValidator::class];

        return $rules;
    }
}
