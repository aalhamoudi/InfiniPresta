<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Copyright extends ModuleCore implements WidgetInterface
{

    public function __construct()
    {
        $this->name = 'copyright';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Infinitivity';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Copyright Information', [], 'Modules.Copyright.Admin');
        $this->description = $this->trans('Displays copyright information.', [], 'Modules.Copyright.Admin');
        $this->ps_versions_compliancy = ['min' => '1.7.5.0', 'max' => _PS_VERSION_];
    }
    public function renderWidget($hookName, array $configuration)
    {
        return '';
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        return [];
    }
}