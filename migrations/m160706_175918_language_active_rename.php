<?php

namespace jarrus90\Multilang\migrations;

class m160706_175918_language_active_rename extends \yii\db\Migration {

    /**
     * Create table.
     */
    public function up() {
        $this->renameColumn('{{%languages}}', 'enabled', 'is_active');
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->renameColumn('{{%languages}}', 'is_active', 'enabled');
    }

}
