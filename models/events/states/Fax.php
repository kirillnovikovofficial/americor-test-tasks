<?php

namespace app\models\events\states;

class Fax extends AbstractState
{
    public const TYPE_POA_ATC = 'poa_atc';
    public const TYPE_REVOCATION_NOTICE = 'revocation_notice';
}