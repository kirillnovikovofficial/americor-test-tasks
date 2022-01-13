<?php

namespace app\models\events;

use app\models\events\states\sms\Incoming as IncomingSmsState;
use app\models\schema\events\Sms as SmsSchema;

class Sms extends SmsSchema
{
    public function isIncoming(): bool
    {
        return $this->direction === IncomingSmsState::DIRECTION_INCOMING;
    }
}
