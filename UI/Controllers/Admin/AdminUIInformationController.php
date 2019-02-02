<?php

require_once _PS_ROOT_DIR_.'framework\\ModuleAdminController.php';
require_once _PS_ROOT_DIR_.'framework\\Widget.php';


class AdminUIInformationController extends InfiniModuleAdminController
{
    public function init() {
        $this->name = 'information';
        $this->title = 'Information';
        $this->sections = ['brandinfo', 'storelocation', 'copyrightinfo'];

        parent::init();
    }
}
