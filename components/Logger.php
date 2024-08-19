<?php

namespace app\components;

use app\components\targets\TargetInterface;
use yii\base\Component;

class Logger extends Component implements LoggerInterface
{
    public string $loggerType;
    public array $availableTypes;
    private array $loggerInstances;

    public function send(string $message): void
    {
        $this->sendByLogger($message, $this->loggerType);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        $this->getLogger($loggerType)->log($message);
    }

    public function getType(): string
    {
        return $this->loggerType;
    }

    public function setType(string $type): void
    {
        if (!isset($this->availableTypes[$type])) {
            throw new \InvalidArgumentException("Unsupported log type: {$type}");
        }

        $this->loggerType = $type;
    }

    private function getLogger(string $loggerType): TargetInterface
    {
        $type = $loggerType ?? $this->loggerType;

        if (!isset($this->availableTypes[$type])) {
            throw new \InvalidArgumentException("Unsupported log type: {$type}");
        }

        if (!isset($this->loggerInstances[$type])) {
            $config = $this->availableTypes[$type];
            $class = $config['class'];
            unset($config['class']);
            $this->loggerInstances[$type] = new $class($config);
        }

        return $this->loggerInstances[$type];
    }
}
