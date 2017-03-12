<?php

use yii\db\Migration;

class m170312_110725_create_stackoverflow_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stackoverflow_search}}', [
            'id' => $this->bigPrimaryKey(),
            'search' =>$this->string(255)->notNull()->defaultValue('')
            
        ], $tableOptions);
        
        
        $this->createTable('{{%stackoverflow_question}}', [
            'id' => $this->bigPrimaryKey(),
            'number' => $this->bigInteger()->notNull(),
            'content' => $this->text()->notNull(),
            'search_id' => $this->bigInteger(),
            
        ], $tableOptions);
        
        $this->addForeignKey(
            'fk_stackoverflow_question_search',
            "{{%stackoverflow_question}}",
            "search_id",
            '{{%stackoverflow_search}}',
            'id',
            "CASCADE",
            "CASCADE"
        );
        
        
        $this->createTable('{{%stackoverflow_answer}}', [
            'id' => $this->bigPrimaryKey(),
            'score' => $this->bigInteger(),
            'content' => $this->text()->notNull(),
            'question_id' => $this->bigInteger(),
        ], $tableOptions);
        
        $this->addForeignKey(
            'fk_stackoverflow_answer_question',
            "{{%stackoverflow_answer}}",
            "question_id",
            '{{%stackoverflow_question}}',
            'id',
            "CASCADE",
            "CASCADE"
        );
    }

    public function down()
    {
        $this->dropForeignKey("fk_stackoverflow_answer_question", "{{%stackoverflow_answer}}");
        $this->dropTable('{{%stackoverflow_answer}}');
        $this->dropForeignKey("fk_stackoverflow_question_search", "{{%stackoverflow_question}}");
        $this->dropTable('{{%stackoverflow_question}}');
        $this->dropTable('{{%stackoverflow_search}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
