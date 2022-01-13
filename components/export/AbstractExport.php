<?php

namespace app\components\export;

use app\models\History;
use app\widgets\HistoryList\ItemFactory;
use Yii;
use yii\db\Query;

abstract class AbstractExport
{
    /** @var string */
    private $filename;

    /** @var bool|resource */
    private $file;

    /** @var string|null */
    private $fileLink;

    public function __construct()
    {
        $this->filename = 'history-' . time();
        $this->fileLink = Yii::$app->getUrlManager()->getHostInfo() . '/web/assets/' . $this->filename;

        $file = Yii::getAlias('@webroot') . '/assets/' . $this->filename;
        $this->file = fopen($file, 'w');
    }

    public function __destruct()
    {
       fclose($this->file);
    }

    public function getFileLink(): ?string
    {
        return $this->fileLink;
    }

    /**
     * @return bool|resource
     */
    public function getFile()
    {
        return $this->file;
    }

    protected function getHistoryModel(Query $query): \Generator
    {
        foreach($query->each() as $historyModel){
            yield $historyModel;
        }
    }

    protected function getRowFormat(History $historyModel): array
    {
        return [
            Yii::$app->getFormatter()->asDatetime($historyModel->ins_ts),
            isset($historyModel->user) ? $historyModel->user->username : Yii::t('app', 'System'),
            $historyModel->object,
            $historyModel->eventText,
            strip_tags($item = ItemFactory::create($historyModel)->getBodyText()),
        ];
    }
}