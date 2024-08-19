<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class LoggerController extends Controller
{
    /**
     * Sends a log message to the default logger.
     */
    public function actionLog()
    {
        $message = bin2hex(random_bytes(32));
        Yii::$app->logger->send($message);
        $type = Yii::$app->logger->getType();

        return "Sent via {$type}: {$message}";
    }

    /**
     * Sends a log message to a special logger.
     *
     * @param string $type
     */
    public function actionLogTo(string $type)
    {
        $message = bin2hex(random_bytes(32));
        Yii::$app->logger->sendByLogger($message, $type);

        return "Sent via {$type}: {$message}";
    }

    /**
     * Sends a log message to all loggers.
     */
    public function actionLogToAll()
    {
        $message = bin2hex(random_bytes(32));
        foreach (array_keys(Yii::$app->logger->availableTypes) as $type) {
            Yii::$app->logger->sendByLogger($message, $type);
        }

        return "Sent via all loggers: {$message}";
    }
}
