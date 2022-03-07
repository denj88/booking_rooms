<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m220307_132008_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
	        'category_id' => $this->integer()->notNull()->comment('ID категории'),
        ]);
		$this->addCommentOnTable('{{%room}}', 'Номера');

		$this->addForeignKey('FK_room_category_id', '{{%room}}', 'category_id', '{{%category}}', 'id');

		$insertData = [];
	    foreach ($this->getDb()->createCommand('select id from {{%category}}')->query()->readAll() as $item) {
		    $insertData[] = [$item['id']];
		    $insertData[] = [$item['id']];
	    }

		if (!empty($insertData)) {
			$this->batchInsert('{{%room}}', ['category_id'], $insertData);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('FK_room_category_id', '{{%room}}');
        $this->dropTable('{{%room}}');
    }
}
