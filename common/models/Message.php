<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $subject
 * @property string $text
 *
 * @property User $sender
 * @property User $receiver
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'subject', 'text'], 'required'],
            [['sender_id', 'receiver_id'], 'integer'],
            [['subject'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 255],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'subject' => 'Subject',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
