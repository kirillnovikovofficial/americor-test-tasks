<?php

namespace app\widgets\HistoryList\models;

use Yii;

class Sms extends Base
{
    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;
        $sms = $historySearch->sms;

        return [
            'user' => $historySearch->user,
            'body' => $this->getBodyText(),
            'footer' => $sms->isIncoming() ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $sms->phone_to ?? ''
                ]),
            'iconIncome' => $sms->isIncoming(),
            'footerDatetime' => $historySearch->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }

    public function getBodyText(): string
    {
        return $sms->message ?? '';
    }
}