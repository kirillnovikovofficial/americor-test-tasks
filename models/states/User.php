<?php

namespace app\models\states;

class User
{
    public const STATUS_DELETED = 0;
    public const STATUS_HIDDEN = 1;
    public const STATUS_ACTIVE = 10;

    public static function getStatuses(): array
    {
        return [self::STATUS_DELETED, self::STATUS_HIDDEN, self::STATUS_ACTIVE];
    }
}
