<?php

use yii\db\Migration;

/**
 * Class m180725_235026_add_access_token_to_user
 */
class m180725_235026_add_access_token_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('user', 'access_token', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('user', 'access_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180725_235026_add_access_token_to_user cannot be reverted.\n";

        return false;
    }
    */
}
