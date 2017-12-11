<?php

use yii\db\Migration;

/**
 * Class m171208_071047_create_promocodes_tbl
 */
class m171208_071047_create_promocodes_tbl extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            '{{promocodes}}', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'tar_zone' => 'varchar(255) NOT NULL',
            'reward' => 'INT(11) NOT NULL',
            'begin_data' => 'INT(11) NOT NULL',
            'end_data' => 'INT(11) NOT NULL',
            'status' => 'INT(1) DEFAULT 0'
        ), 'DEFAULT CHARSET=utf8 ENGINE = INNODB'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171208_071047_create_promocodes_tbl cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171208_071047_create_promocodes_tbl cannot be reverted.\n";

        return false;
    }
    */
}
