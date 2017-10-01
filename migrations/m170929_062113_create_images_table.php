<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m170929_062113_create_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'img_name'=> $this->string(255)->notNull(),
            'img_title' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('images');
    }
}
