<?php

use yii\db\Schema;
use yii\db\Migration;

class m171130_112207_freelance extends Migration
{
    public function up()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		//order table
		$this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
			'category' => Schema::TYPE_STRING,
			'description' => Schema::TYPE_STRING,
			'skills' => Schema::TYPE_STRING,
			'currency' => Schema::TYPE_STRING,
			'price' => Schema::TYPE_MONEY,
			'dateA' => Schema::TYPE_STRING,
			'dateB' => Schema::TYPE_STRING,
			'worker_login' => Schema::TYPE_STRING,
            'status' => $this->string()->defaultValue('Активный'),
        ], $tableOptions);
		
		$this->addForeignKey('fk-order-user_id-id', '{{%order}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
		
		//bid table
		$this->createTable('{{%bid}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
			'user_id' => Schema::TYPE_INTEGER,
			'currency' => Schema::TYPE_STRING,
			'price' => Schema::TYPE_MONEY,
            'term' => Schema::TYPE_INTEGER,
            'comment' => Schema::TYPE_STRING,
            'status' => $this->string()->defaultValue('Активная'),
        ], $tableOptions);
		
		$this->addForeignKey('fk-bid-order_id-id', '{{%bid}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-bid-user_id-id', '{{%bid}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
		
		
		//payment table
		$this->createTable('{{%payment}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
        ], $tableOptions);
		
		$this->addForeignKey('fk-payment-order_id-id', '{{%payment}}', 'order_id', '{{%order}}', 'id', 'CASCADE');

		
		
		//message table
		$this->createTable('{{%message}}', [
            'id' => Schema::TYPE_PK,
            'sender_id' => Schema::TYPE_INTEGER,
			'receiver_id' => Schema::TYPE_INTEGER,
            'subject' => Schema::TYPE_STRING,
            'text' => Schema::TYPE_STRING,
        ], $tableOptions);

		$this->addForeignKey('fk-message-sender_id-id', '{{%message}}', 'sender_id', '{{%user}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-message-receiver_id-id', '{{%message}}', 'receiver_id', '{{%user}}', 'id', 'CASCADE');
		
    }

    public function down()
    {
        $this->dropTable('{{%message}}');
		$this->dropTable('{{%payment}}');
		$this->dropTable('{{%bid}}');
		$this->dropTable('{{%order}}');
    }

}
