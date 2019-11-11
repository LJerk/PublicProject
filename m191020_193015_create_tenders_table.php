<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tenders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%customers}}`
 */
class m191020_193015_create_tenders_table extends Migration
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

        $this->createTable('{{%tenders}}', [
          'tender_id' => $this->primaryKey(),
          'customer_id' => $this->integer()->notNull(),
          'tender_name' => $this->string()->notNull(),
          'tender_description' => $this->string()->notNull(),
          'status' => $this->smallInteger()->notNull()->defaultValue(10),
          'dateofcreate' => $this->date()->notNull(),
        ], $tableOptions);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-tenders-customer_id}}',
            '{{%tenders}}',
            'customer_id'
        );

        // add foreign key for table `{{%customers}}`
        $this->addForeignKey(
            '{{%fk-tenders-customer_id}}',
            '{{%tenders}}',
            'customer_id',
            '{{%customers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops foreign key for table `{{%customers}}`
        $this->dropForeignKey(
            '{{%fk-tenders-customer_id}}',
            '{{%tenders}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-tenders-customer_id}}',
            '{{%tenders}}'
        );

        $this->dropTable('{{%tenders}}');
    }
}
