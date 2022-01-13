<?php

namespace app\widgets\HistoryList\models;

class Task extends Base
{
    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;
        $task = $historySearch->task;

        return [
            'user' => $historySearch->user,
            'body' => $this->getBodyText(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $historySearch->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ];
    }

    public function getBodyText(): string
    {
        return "{$this->historySearch->eventText}: " . ($this->historySearch->task->title ?? '');
    }

}