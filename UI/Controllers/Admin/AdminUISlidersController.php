<?php

require_once _PS_ROOT_DIR_.'framework\\ModuleAdminController.php';
require_once _PS_ROOT_DIR_.'framework\\Widget.php';


class AdminUISlidersController extends InfiniModuleAdminController
{
    public function init() {
        $this->name = 'imagesliders';
        $this->title = 'Image Sliders';

        parent::init();
    }
}
