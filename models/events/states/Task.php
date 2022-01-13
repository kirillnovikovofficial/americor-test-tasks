<?php

namespace app\models\events\states;

class Task extends AbstractState
{
    public const STATUS_NEW = 0;
    public const STATUS_DONE = 1;
    public const STATUS_CANCEL = 3;

    public const STATE_INBOX = 'inbox';
    public const STATE_DONE = 'done';
    public const STATE_FUTURE = 'future';
}