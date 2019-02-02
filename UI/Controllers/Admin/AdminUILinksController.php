<?php

require_once _PS_ROOT_DIR_.'framework\\ModuleAdminController.php';
require_once _PS_ROOT_DIR_.'framework\\Widget.php';


class AdminUILinksController extends InfiniModuleAdminController
{
    public function init() {
        $this->name = 'links';
        $this->title = 'Links';

        parent::init();
    }
}
