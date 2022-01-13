<?php

namespace app\widgets\HistoryList\models;

class Call extends Base
{
    public function getRenderParams(): array
    {
        $historySearch = $this->historySearch;
        $call = $historySearch->call;

        return [
            'user' => $historySearch->user,
            'content' => $call->comment ?? '',
            'body' =>  $this->getBodyText(),
            'footerDatetime' => $historySearch->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $this->getIconClass(),
            'iconIncome' => $this->getIconIncome(),
        ];
    }

    public function getBodyText(): string
    {
        $call = $this->historySearch->call;
        if ($call === null) {
            return '<i>Deleted</i>';
        }
        if (!$call->getTotalDisposition()) {
            return $call->totalStatusText;
        }
        return $call->totalStatusText . ' <span class=\'text-grey\'>' . $call->getTotalDisposition() . '</span>';
    }

    private function getIconClass(): ?string
    {
        $call = $this->historySearch->call;
        if ($call === null) {
            return null;
        }

        return $call->isAnswered() ? 'md-phone bg-green' : 'md-phone-missed bg-red';
    }

    private function getIconIncome(): bool
    {
        $call = $this->historySearch->call;
        if ($call === null) {
            return false;
        }

        return $call->isAnswered() && $call->isIncoming();
    }
}