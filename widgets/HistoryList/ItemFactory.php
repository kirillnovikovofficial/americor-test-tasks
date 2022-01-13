<?php

namespace app\widgets\HistoryList;

use app\widgets\HistoryList\interfaces\ItemInterface;
use app\widgets\HistoryList\models\Base;
use app\models\History;
use app\models\states\History as HistoryState;

class ItemFactory
{
    private const ALIASES = [
        HistoryState::EVENT_CREATED_TASK => 'Task',
        HistoryState::EVENT_COMPLETED_TASK => 'Task',
        HistoryState::EVENT_UPDATED_TASK => 'Task',

        HistoryState::EVENT_INCOMING_SMS => 'Sms',
        HistoryState::EVENT_OUTGOING_SMS => 'Sms',

        HistoryState::EVENT_OUTGOING_FAX => 'Fax',
        HistoryState::EVENT_INCOMING_FAX => 'Fax',

        HistoryState::EVENT_INCOMING_CALL => 'Call',
        HistoryState::EVENT_OUTGOING_CALL => 'Call',

        HistoryState::EVENT_CUSTOMER_CHANGE_TYPE => 'CustomerType',
        HistoryState::EVENT_CUSTOMER_CHANGE_QUALITY => 'CustomerQuality',
    ];

    public static function create(History $model): ItemInterface
    {
        $objectName = self::ALIASES[$model->event] ?? null;
        $class = __NAMESPACE__ . '\\models\\' . $objectName;
        if ($objectName === null || !class_exists($class)) {
            return new Base($model);
        }

        return new $class($model);
    }
}