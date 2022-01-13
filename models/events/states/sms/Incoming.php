<?php

namespace app\models\events\states\sms;

use app\models\events\states\AbstractState;

class Incoming extends AbstractState
{
    public const STATUS_NEW = 0;
    public const STATUS_READ = 1;
    public const STATUS_ANSWERED = 2;
}