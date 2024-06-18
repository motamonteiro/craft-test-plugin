<?php

namespace motamonteiro\craftentryexplorer;

use Craft;
use craft\base\Element;
use craft\base\Model;
use craft\base\Plugin;
use craft\elements\Entry;
use craft\events\DefineBehaviorsEvent;
use craft\web\twig\variables\CraftVariable;
use motamonteiro\craftentryexplorer\behaviors\EntryExplorerBehavior;
use motamonteiro\craftentryexplorer\models\Settings;
use motamonteiro\craftentryexplorer\services\EntryExplorerService;
use motamonteiro\craftentryexplorer\variables\EntryExplorerVariable;
use yii\base\Event;

/**
 * Entry Explorer plugin
 *
 * @method static EntryExplorer getInstance()
 * @method Settings getSettings()
 * @author Alexandre Monteiro <motamonteiro@gmail.com>
 * @copyright Alexandre Monteiro
 * @license MIT
 */
class EntryExplorer extends Plugin
{
    /**
     * @var EntryExplorer
     */
    public static EntryExplorer $plugin;

    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = false;
    public bool $hasCpSection = true;

    public static function config(): array
    {
        return [
            'components' => [
                'entryExplorer' => ['class' => EntryExplorerService::class],
            ],
        ];
    }

    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Register variable
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('entryExplorer', EntryExplorerVariable::class);
        });

        Event::on(Element::class, Element::EVENT_DEFINE_BEHAVIORS, function (DefineBehaviorsEvent $event) {
            /** @var Element $element */
            $element = $event->sender;
            if ($element instanceof Entry) {
                $event->behaviors['entryExplorer'] = EntryExplorerBehavior::class;
            }
        });

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function () {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('entry-explorer/settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
