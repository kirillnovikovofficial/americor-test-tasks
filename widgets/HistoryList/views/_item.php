<?php

use app\models\History;
use app\widgets\HistoryList\ItemFactory;

/** @var $model History */

$item = ItemFactory::create($model);

echo $this->render($item->getViewName(), $item->getRenderParams());