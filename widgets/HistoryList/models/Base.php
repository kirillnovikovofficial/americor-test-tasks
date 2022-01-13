<?php

namespace app\widgets\HistoryList\models;

use app\models\History;
use app\widgets\HistoryList\interfaces\ItemInterface;

class Base implements ItemInterface
{
    protected $historySearch;

    public function __construct(History $historySearch)
    {
        $this->historySearch = $historySearch;
    }

    public function getViewName(): string
    {
        return '_item_common';
    }

    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;

        return [
            'user' => $historySearch->user,
            'body' => $historySearch->eventText,
            'bodyDatetime' => $historySearch->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }

    public function getBodyText(): string
    {
        return '';
    }
}