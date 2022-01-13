<?php

namespace app\models\events;

use app\models\schema\events\Task as TaskSchema;

class Task extends TaskSchema
{
    public function getStatusTextByValue(int $value): string
    {
        return self::getStatusTexts()[$value] ?? $value;
    }

    public function getStatusText(): string
    {
        return self::getStatusTextByValue($this->status);
    }

    public function getStateText(): string
    {
        return self::getStateTexts()[$this->state] ?? $this->state;
    }

}
