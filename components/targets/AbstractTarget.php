<?php

namespace app\components\targets;

use yii\base\Component;

abstract class AbstractTarget extends Component implements TargetInterface
{
    abstract protected function prepareMessage(string $message): string;
}