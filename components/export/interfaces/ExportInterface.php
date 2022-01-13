<?php

namespace app\components\export\interfaces;

use yii\db\Query;

interface ExportInterface
{
    public function export(Query $query): string;
}