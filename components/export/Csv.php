<?php

namespace app\components\export;

use app\components\export\interfaces\ExportInterface;
use yii\db\Query;

class Csv extends AbstractExport implements ExportInterface
{
    public const FORMAT = 'Csv';

    public function export(Query $query): string
    {
        foreach ($this->getHistoryModel($query) as $historyModel) {
            fputcsv($this->getFile(), $this->getRowFormat($historyModel));
        }

        return $this->getFileLink();
    }
}