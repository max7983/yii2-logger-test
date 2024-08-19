<?php

namespace app\components\targets;

class EmailTarget extends AbstractTarget
{
    public string $from;
    public string $to;
    public string $subject;

    public function log(string $message): void
    {
        \Yii::$app->mailer->compose()
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->setTextBody($message)
            ->setHtmlBody('<p>' . $this->prepareMessage($message) . '</p>')
            ->send();
    }

    protected function prepareMessage(string $message): string
    {
        return htmlspecialchars($message);
    }
}