<?php

namespace app\models\events\states;

abstract class AbstractState
{
    public const DIRECTION_INCOMING = 0;
    public const DIRECTION_OUTGOING = 1;
}