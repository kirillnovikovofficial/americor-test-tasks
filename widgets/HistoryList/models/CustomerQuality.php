<?php

namespace app\widgets\HistoryList\models;

use app\models\Customer;

class CustomerQuality extends Base
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
            'oldValue' => Customer::getTypeTextByType($historySearch->getDetailOldValue('quality')),
            'newValue' => Customer::getTypeTextByType($historySearch->getDetailNewValue('quality')),
        ];
    }
}