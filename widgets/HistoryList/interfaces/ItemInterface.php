<?php

namespace app\widgets\HistoryList\interfaces;

use app\models\History;

interface ItemInterface
{
    public function __construct(History $historySearch);

    public function getViewName(): string;

    public function getRenderParams(): array;
}