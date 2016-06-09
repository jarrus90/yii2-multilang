<?php

class m151001_114140_create_language_table extends \yii\db\Migration {

    /**
     * Create table.
     */
    public function up() {
        $tableOptions = null;
        if (Yii::$app->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%languages}}', [
            'code' => $this->string(10)->notNull(),
            'name' => $this->string(255)->notNull(),
            'flag' => $this->string(255),
            'enabled' => $this->boolean()->defaultValue(false),
            'PRIMARY KEY (code)',
                ], $tableOptions);
        $this->insert('{{%languages}}', [
            'code' => 'en',
            'name' => 'English',
            'flag' => 'gb',
            'enabled' => true
        ]);
        $this->insert('{{%languages}}', [
            'code' => 'ru',
            'name' => 'Русский',
            'flag' => 'ru',
            'enabled' => true
        ]);
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->dropTable('{{%languages}}');
    }

}
