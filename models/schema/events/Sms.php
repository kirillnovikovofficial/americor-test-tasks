<?php

namespace app\models\schema\events;

use app\models\Customer;
use app\models\events\states\sms\Incoming;
use app\models\events\states\sms\Outgoing;
use app\models\User;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%sms}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $customer_id
 * @property integer $status
 * @property string $phone_from
 * @property string $message
 * @property string $ins_ts
 * @property integer $direction
 * @property string $phone_to
 * @property integer $type
 * @property string $formatted_message
 *
 * @property string $statusText
 * @property string $directionText
 *
 * @property Customer $customer
 * @property User $user
 */
class Sms extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone_to', 'direction'], 'required'],
            [['user_id', 'customer_id', 'status', 'direction', 'applicant_id', 'type'], 'integer'],
            [['message'], 'string'],
            [['ins_ts'], 'safe'],
            [['phone_from', 'phone_to'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'status' => Yii::t('app', 'Status'),
            'statusText' => Yii::t('app', 'Status'),
            'phone_from' => Yii::t('app', 'Phone From'),
            'phone_to' => Yii::t('app', 'Phone To'),
            'message' => Yii::t('app', 'Message'),
            'ins_ts' => Yii::t('app', 'Date'),
            'direction' => Yii::t('app', 'Direction'),
            'directionText' => Yii::t('app', 'Direction'),
            'user.fullname' => Yii::t('app', 'User'),
            'customer.name' => Yii::t('app', 'Client'),
        ];
    }

    public function getCustomer(): ActiveQuery
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getStatusTexts(): array
    {
        return [
            Incoming::STATUS_NEW => Yii::t('app', 'New'),
            Incoming::STATUS_READ => Yii::t('app', 'Read'),
            Incoming::STATUS_ANSWERED => Yii::t('app', 'Answered'),

            Outgoing::STATUS_DRAFT => Yii::t('app', 'Draft'),
            Outgoing::STATUS_WAIT => Yii::t('app', 'Wait'),
            Outgoing::STATUS_SENT => Yii::t('app', 'Sent'),
            Outgoing::STATUS_DELIVERED => Yii::t('app', 'Delivered'),
        ];
    }

    public static function getStatusTextByValue(int $status): string
    {
        return self::getStatusTexts()[$status] ?? $status;
    }

    public static function getDirectionTexts(): array
    {
        return [
            Incoming::DIRECTION_INCOMING => Yii::t('app', 'Incoming'),
            Outgoing::DIRECTION_OUTGOING => Yii::t('app', 'Outgoing'),
        ];
    }

    public static function getDirectionTextByValue(int $value): string
    {
        return self::getDirectionTexts()[$value] ?? $value;
    }
}
