<?php

namespace app\models\schema;

use app\models\states\User as UserState;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $statusText
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'created_at', 'updated_at'], 'required'],
            [[
                'status',
                'created_at',
                'updated_at',
            ], 'integer'],
            [[
                'username',
                'email',
            ], 'string', 'max' => 255],

            [['username'], 'unique'],

            ['status', 'default', 'value' => UserState::STATUS_ACTIVE],
            ['status', 'in', 'range' => UserState::getStatuses()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username (login)'),
            'statusText' => Yii::t('app', 'Status'),
        ];
    }

    public static function getStatusTexts(): array
    {
        return [
            UserState::STATUS_ACTIVE => Yii::t('app', 'Active'),
            UserState::STATUS_DELETED => Yii::t('app', 'Deleted'),
            UserState::STATUS_HIDDEN => Yii::t('app', 'Hidden'),
        ];
    }

    public function getStatusText(): string
    {
        return self::getStatusTexts()[$this->status] ?? $this->status;
    }
}
