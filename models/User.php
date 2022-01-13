<?php

namespace app\models;

use app\models\schema\User as UserSchema;

class User extends UserSchema
{
    public function getStatusText(): string
    {
        return self::getStatusTexts()[$this->status] ?? $this->status;
    }
}
