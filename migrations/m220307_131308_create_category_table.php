<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220307_131308_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
	        'name' => $this->string()->notNull()->comment('Название категории'),
	        'rooms_count' => $this->tinyInteger(1)->unsigned()->comment('Кол-во комнат')
        ]);
		$this->addCommentOnTable('{{%category}}', 'Категории номеров');

		$this->batchInsert('{{%category}}', ['name', 'rooms_count'], [
			['Одноместный', 2],
			['Двуместный', 4],
			['Люкс', 3],
			['Де-Люк', 5],
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
