<?php

require_once _PS_ROOT_DIR_.'framework\\ModuleAdminController.php';
require_once _PS_ROOT_DIR_.'framework\\Widget.php';


class AdminUIBlocksController extends InfiniModuleAdminController
{
    public function init() {
        $this->name = 'customblocks';
        $this->title = 'Custom Blocks';

        parent::init();
    }
}
