<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $title
 * @property string $category
 * @property string $description
 * @property string $skills
 * @property string $currency
 * @property string $price
 * @property string $method
 * @property string $dateA
 * @property string $dateB
 * @property string $worker_login
 *
 * @property Bid[] $bs
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'title', 'category', 'description', 'skills', 'currency', 'dateA', 'dateB'], 'required'],
            [['user_id'], 'integer'],
            [['price'], 'number'],
            [['type', 'status'], 'string', 'max' => 30],
            [['title', 'category', 'skills'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 5],
            [['dateA', 'dateB'], 'string', 'max' => 11],
            [['worker_login'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID заказчика',
            'type' => 'Тип',
            'title' => 'Название',
            'category' => 'Категория',
            'description' => 'Описание',
            'skills' => 'Навыки',
            'currency' => 'Валюта',
            'price' => 'Оплата',
            'dateA' => 'Создан',
            'dateB' => 'Активный до',
            'worker_login' => 'Логин исполнителя',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBs()
    {
        return $this->hasMany(Bid::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	
	public function getMethods()
    {
        return $this->hasMany(Payment::className(), ['order_id' => 'id']);
    }
}
