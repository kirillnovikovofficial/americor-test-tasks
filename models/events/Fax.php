<?php

namespace app\models\events;

use app\models\events\states\Fax as FaxState;
use app\models\schema\events\Fax as FaxSchema;
use Yii;

class Fax extends FaxSchema
{
    public function getTypeText(): ?string
    {
        return self::getTypeTexts()[$this->type] ?? $this->type;
    }
}
