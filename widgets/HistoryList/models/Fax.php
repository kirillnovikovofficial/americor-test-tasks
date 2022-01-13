<?php

namespace app\widgets\HistoryList\models;

use Yii;
use yii\helpers\Html;

class Fax extends Base
{
    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;
        $fax = $historySearch->fax;

        return [
            'user' => $historySearch->user,
            'body' => $this->getBodyText() . $this->getBodyDocument(),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $historySearch->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ];
    }

    public function getBodyText(): string
    {
        return $this->historySearch->eventText;
    }

    private function getBodyDocument(): string
    {
        if (!isset($fax->document)) {
            return '';
        }

        return ' - ' . Html::a(
            Yii::t('app', 'view document'),
            $this->historySearch->fax->document->getViewUrl(),
            [
                'target' => '_blank',
                'data-pjax' => 0
            ]
        );
    }

}