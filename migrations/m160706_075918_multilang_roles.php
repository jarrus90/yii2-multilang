<?php

use jarrus90\User\migrations\RbacMigration;

class m160706_075918_multilang_roles extends RbacMigration {

    public function up() {
        
        $admin = $this->authManager->getRole('admin');
        $adminSuper = $this->authManager->getRole('admin_super');
        $languagesAdmin = $this->createRole('languages_admin', 'Multilanguage administrator');
        $this->assignChildRole($languagesAdmin, $admin);
        $this->assignChildRole($adminSuper, $languagesAdmin);
    }

    public function down() {
        
    }

}
