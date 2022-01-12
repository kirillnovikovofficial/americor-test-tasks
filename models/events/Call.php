<?php

namespace app\models\events;

use app\models\events\schema\Call as CallSchema;
use app\models\events\states\Call as CallState;

use Yii;

class Call extends CallSchema
{
    public function getClient_phone(): string
    {
        return $this->direction == CallState::DIRECTION_INCOMING ? $this->phone_from : $this->phone_to;
    }

    /**
     * @return mixed|string
     */
    public function getTotalStatusText()
    {
        if ($this->status == CallState::STATUS_NO_ANSWERED) {
           if ($this->direction == CallState::DIRECTION_INCOMING) {
               return Yii::t('app', 'Missed Call');
           }
            if ($this->direction == CallState::DIRECTION_OUTGOING) {
                return Yii::t('app', 'Missed Call');
            }
        }

        $msg = $this->getFullDirectionText();
        if (!CallState::$duration) {
            return $msg;
        }

        $msg .= ' (' . $this->getDurationText() . ')';

        return $msg;
    }

    public function getTotalDisposition(): string
    {
        return '';
    }

    public function getTotalDispositionWithComment(): string
    {
        return $this->comment ? $this->comment : '';
    }

    public function getDurationText(): string
    {
        return Yii::$app->getFormatter()->asTime(CallState::$duration);

        if (CallState::$duration === null) {
            return '00:00';
        }
        return CallState::$duration >= 3600 ? gmdate("H:i:s", CallState::$duration) : gmdate("i:s", CallState::$duration);
    }
}
