<?php

namespace app\models\events\states;

class Call extends AbstractState
{
    public const STATUS_NO_ANSWERED = 0;
    public const STATUS_ANSWERED = 1;

    public const SECOND_IN_HOUR = 3600;

    public static $duration = 720;
}