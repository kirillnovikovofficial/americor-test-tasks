<?php

namespace app\models\events\states\sms;

use app\models\events\states\AbstractState;

class Outgoing extends AbstractState
{
    public const STATUS_DRAFT = 10;
    public const STATUS_WAIT = 11;
    public const STATUS_SENT = 12;
    public const STATUS_DELIVERED = 13;
    public const STATUS_FAILED = 14;
    public const STATUS_SUCCESS = 13;
}