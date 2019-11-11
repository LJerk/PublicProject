<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m191111_080223_create_orders_table extends Migration
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

         $this->createTable('{{%orders}}', [
           'order_id' => $this->primaryKey(),
           'provider_id' => $this->integer()->notNull(),
           'product' => $this->string()->notNull(),
           'price' => $this->double()->notNull(),
           'count' => $this->smallInteger()->notNull(),
         ], $tableOptions);

         // creates index for column `provider_id`
         $this->createIndex(
             '{{%idx-orders-provider_id}}',
             '{{%orders}}',
             'provider_id'
         );

         // add foreign key for table `{{%provider}}`
         $this->addForeignKey(
             '{{%fk-orders-provider_id}}',
             '{{%orders}}',
             'provider_id',
             '{{%provider}}',
             'id',
             'CASCADE'
         );
     }

    /**
     * {@inheritdoc}
     */
     public function down()
     {
         // drops foreign key for table `{{%orders}}`
         $this->dropForeignKey(
             '{{%fk-orders-provider_id}}',
             '{{%orders}}'
         );

         // drops index for column `provider_id`
         $this->dropIndex(
             '{{%idx-orders-provider_id}}',
             '{{%orders}}'
         );

         $this->dropTable('{{%tenders}}');
     }
}
