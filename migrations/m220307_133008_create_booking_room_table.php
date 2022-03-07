<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_room}}`.
 */
class m220307_133008_create_booking_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_room}}', [
            'id' => $this->primaryKey(),
	        'room_id' => $this->integer()->notNull()->comment('ID номера'),
	        'date_from' => $this->date()->notNull()->comment('Дата бронирования от'),
	        'date_to' => $this->date()->notNull()->comment('Дата бронирования до'),
	        'email' => $this->string()->notNull()->comment('E-mail'),
	        'name' => $this->string()->notNull()->comment('Имя'),
        ]);
		$this->addCommentOnTable('{{%booking_room}}', 'Бронирование номеров');

		$this->addForeignKey('FK_booking_room_room_id', '{{%booking_room}}', 'room_id', '{{%room}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('FK_booking_room_room_id', '{{%booking_room}}');
        $this->dropTable('{{%booking_room}}');
    }
}
