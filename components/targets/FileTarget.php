<?php

namespace app\components\targets;

use Yii;

class FileTarget extends AbstractTarget
{
    public string $path;

    public function log(string $message): void
    {
        file_put_contents(
            $this->getFilePath(),
            $this->prepareMessage($message) . PHP_EOL,
            FILE_APPEND
        );
    }

    protected function prepareMessage(string $message): string
    {
        return date('Y-m-d H:i:s') . ' ' . $message;
    }

    protected function getFilePath()
    {
        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getFilename();
    }

    protected function getPath()
    {
        return trim(Yii::getAlias($this->path), DIRECTORY_SEPARATOR);
    }

    protected function getFilename()
    {
        return date('Ymd') . '.log';
    }
}