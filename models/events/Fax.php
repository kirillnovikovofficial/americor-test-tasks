<?php

namespace app\models\events;

use app\models\schema\events\Fax as FaxSchema;

class Fax extends FaxSchema
{
    public function getTypeText(): ?string
    {
        return self::getTypeTexts()[$this->type] ?? $this->type;
    }
}
