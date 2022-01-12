<?php

namespace app\models\states;

class Customer
{
    public const QUALITY_ACTIVE = 'active';
    public const QUALITY_REJECTED = 'rejected';
    public const QUALITY_COMMUNITY = 'community';
    public const QUALITY_UNASSIGNED = 'unassigned';
    public const QUALITY_TRICKLE = 'trickle';

    public const TYPE_LEAD = 'lead';
    public const TYPE_DEAL = 'deal';
    public const TYPE_LOAN = 'loan';
}