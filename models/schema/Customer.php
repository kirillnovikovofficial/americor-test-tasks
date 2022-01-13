<?php

namespace app\models\schema;

use app\models\states\Customer as CustomerState;
use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $name
 */
class Customer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public static function getQualityTexts(): array
    {
        return [
            CustomerState::QUALITY_ACTIVE => Yii::t('app', 'Active'),
            CustomerState::QUALITY_REJECTED => Yii::t('app', 'Rejected'),
            CustomerState::QUALITY_COMMUNITY => Yii::t('app', 'Community'),
            CustomerState::QUALITY_UNASSIGNED => Yii::t('app', 'Unassigned'),
            CustomerState::QUALITY_TRICKLE => Yii::t('app', 'Trickle'),
        ];
    }

    public static function getQualityTextByQuality(?string $quality): ?string
    {
        return self::getQualityTexts()[$quality] ?? $quality;
    }

    public static function getTypeTexts(): array
    {
        return [
            CustomerState::TYPE_LEAD => Yii::t('app', 'Lead'),
            CustomerState::TYPE_DEAL => Yii::t('app', 'Deal'),
            CustomerState::TYPE_LOAN => Yii::t('app', 'Loan'),
        ];
    }

    public static function getTypeTextByType(?string $type): ?string
    {
        return self::getTypeTexts()[$type] ?? $type;
    }
}