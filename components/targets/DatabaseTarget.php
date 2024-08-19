<?php

namespace app\components\targets;

class DatabaseTarget extends AbstractTarget
{
    public string $table;

    public function log(string $message): void
    {
        \Yii::$app->db->createCommand()
            ->insert($this->table, [
                'message' => $this->prepareMessage($message)
            ])
            ->execute();
    }

    protected function prepareMessage(string $message): string
    {
        return mb_substr($message, 0, 65535);
    }
}