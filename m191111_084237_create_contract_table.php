<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%customer}}`
 * - `{{%provider}}`
 */
class m191111_084237_create_contract_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract}}', [
            'contract_id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'provider_id' => $this->integer()->notNull(),
            'product' => $this->string()->notNull(),
            'count' => $this->smallInteger()->notNull(),
            'price' => $this->double()->notNull(),
            'date_of_executions' => $this->date()->notNull(),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-contract-customer_id}}',
            '{{%contract}}',
            'customer_id'
        );

        // add foreign key for table `{{%customer}}`
        $this->addForeignKey(
            '{{%fk-contract-customer_id}}',
            '{{%contract}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );

        // creates index for column `provider_id`
        $this->createIndex(
            '{{%idx-contract-provider_id}}',
            '{{%contract}}',
            'provider_id'
        );

        // add foreign key for table `{{%provider}}`
        $this->addForeignKey(
            '{{%fk-contract-provider_id}}',
            '{{%contract}}',
            'provider_id',
            '{{%provider}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%customer}}`
        $this->dropForeignKey(
            '{{%fk-contract-customer_id}}',
            '{{%contract}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-contract-customer_id}}',
            '{{%contract}}'
        );

        // drops foreign key for table `{{%provider}}`
        $this->dropForeignKey(
            '{{%fk-contract-provider_id}}',
            '{{%contract}}'
        );

        // drops index for column `provider_id`
        $this->dropIndex(
            '{{%idx-contract-provider_id}}',
            '{{%contract}}'
        );

        $this->dropTable('{{%contract}}');
    }
}
