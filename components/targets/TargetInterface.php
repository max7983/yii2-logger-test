<?php

namespace app\components\targets;

interface TargetInterface
{
    public function log(string $message): void;
}