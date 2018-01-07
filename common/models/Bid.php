<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bid".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property string $currency
 * @property string $price
 * @property integer $term
 * @property string $comment
 *
 * @property User $user
 * @property Order $order
 */
class Bid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'currency', 'price'], 'required'],
            [['order_id', 'user_id', 'term'], 'integer'],
            [['price'], 'number'],
            [['currency'], 'string', 'max' => 5],
			[['status'], 'string', 'max' => 12],
            [['comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'ID заказа',
            'user_id' => 'ID заказчика',
            'currency' => 'Валюта',
            'price' => 'Цена',
            'term' => 'Срок (дни)',
            'comment' => 'Краткий комментарий',
			'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
