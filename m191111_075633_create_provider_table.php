<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%provider}}`.
 */
class m191111_075633_create_provider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
       {
           $tableOptions = null;

           if ($this->db->driverName === 'mysql')
           {
               $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
           }

           $this->createTable('{{%provider}}', [
               'provider_id' => $this->primaryKey(),
               'company_name' => $this->string()->notNull()->unique(),
               'auth_key' => $this->string(32)->notNull(),
               'password_hash' => $this->string()->notNull(),
               'password_reset_token' => $this->string()->unique(),
               'email' => $this->string()->notNull()->unique(),
               'status' => $this->smallInteger()->notNull()->defaultValue(10),
               'created_at' => $this->integer()->notNull(),
               'updated_at' => $this->integer()->notNull(),
               'orgn' => $this->string()->notNull()->unique(),
               'inn' => $this->string()->notNull()->unique(),
           ], $tableOptions);
       }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%provider}}');
    }
}
