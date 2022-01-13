<?php

namespace app\widgets\HistoryList\models;

use app\models\Customer;

class CustomerType extends Base
{
    public function getViewName(): string
    {
        return '_item_statuses_change';
    }

    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;

        return [
            'model' => $historySearch,
            'oldValue' => Customer::getTypeTextByType($historySearch->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($historySearch->getDetailNewValue('type')),
        ];
    }

    public function getBodyText(): string
    {
        return "{$this->historySearch->eventText} " .
            (Customer::getQualityTextByQuality($this->historySearch->getDetailOldValue('type')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($this->historySearch->getDetailNewValue('type')) ?? "not set");
    }
}