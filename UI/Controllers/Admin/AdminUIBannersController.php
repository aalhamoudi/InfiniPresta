<?php

require_once _PS_ROOT_DIR_.'framework\\ModuleAdminController.php';
require_once _PS_ROOT_DIR_.'framework\\Widget.php';


class AdminUIBannersController extends InfiniModuleAdminController
{
    public function init() {
        $this->name = 'banners';
        $this->tite = 'Banners';

        parent::init();
    }
}
