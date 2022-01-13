<?php

namespace app\models\schema\events;

use app\models\User;
use app\models\events\states\Fax as FaxState;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fax".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $user_id
 * @property string $from
 * @property string $to
 * @property integer $status
 * @property integer $direction
 * @property integer $type
 * @property string $typeText
 *
 * @property User $user
 */
class Fax extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['ins_ts'], 'safe'],
            [['user_id'], 'integer'],
            [['from', 'to'], 'string'],
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
            'ins_ts' => Yii::t('app', 'Created Time'),
            'user_id' => Yii::t('app', 'User ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To')
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getTypeTexts(): array
    {
        return [
            FaxState::TYPE_POA_ATC => Yii::t('app', 'POA/ATC'),
            FaxState::TYPE_REVOCATION_NOTICE => Yii::t('app', 'Revocation'),
        ];
    }

    public function getTypeText(): string
    {
        return self::getTypeTexts()[$this->type] ?? $this->type;
    }

}
