<?php

/**
 * @copyright Copyright (c) MotaMonteiro
 */

namespace motamonteiro\craftentryexplorer\controllers;

use Craft;
use \craft\web\Controller;
use motamonteiro\craftentryexplorer\EntryExplorer;
use yii\web\Response;

/**
 * EntryExplorerController
 */
class EntryExplorerController extends Controller
{
    /**
     * Reset to import plugin data again
     */
    public function actionReset(): Response
    {
        EntryExplorer::$plugin->entryExplorer->importPluginData();
        Craft::$app->session->setNotice(Craft::t('entry-explorer', 'Plugin data imported again'));
        return $this->redirectToPostedUrl();
    }
}
