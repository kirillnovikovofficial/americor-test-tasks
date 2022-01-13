<?php

namespace app\widgets\HistoryList\helpers;

use app\models\events\Call;
use app\models\Customer;
use app\models\History;
use app\models\states\History as HistoryState;

class HistoryListHelper
{
    public static function getBodyByModel(History $model)
    {
        switch ($model->event) {
            case HistoryState::EVENT_CREATED_TASK:
            case HistoryState::EVENT_COMPLETED_TASK:
            case HistoryState::EVENT_UPDATED_TASK:
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            case HistoryState::EVENT_INCOMING_SMS:
            case HistoryState::EVENT_OUTGOING_SMS:
                return $model->sms->message ? $model->sms->message : '';
            case HistoryState::EVENT_OUTGOING_FAX:
            case HistoryState::EVENT_INCOMING_FAX:
                return $model->eventText;
            case HistoryState::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case HistoryState::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            case HistoryState::EVENT_INCOMING_CALL:
            case HistoryState::EVENT_OUTGOING_CALL:
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition() ? " <span class='text-grey'>" . $call->getTotalDisposition() . "</span>" : "") : '<i>Deleted</i> ');
            default:
                return $model->eventText;
        }
    }
}