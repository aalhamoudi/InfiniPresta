<?php

namespace Infini;


class FrontAdapter extends ModuleFrontController
{
    //public $className = 'LinkBlock';
    protected $name;
    protected $repository;
    
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view';

        parent::__construct();

        if (!$this->module->active)
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        

        $this->addJs($this->Code());
        $this->addCss($this->Styles());
    }

    public function init()
    {
        parent::init();
    }

    public function initContent() 
    {
        parent::initContent();
        return $this->View();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('action')) {
            switch (Tools::getValue('action')) {
                case 'updatePositions':
                    $this->updatePositions();
                    break;
            }
        } elseif (Tools::isSubmit('submit'.$this->className)) {
            if (!$this->manageLinkList()) {
                return false;
            }

            $hook_name = Hook::getNameById(Tools::getValue('id_hook'));
            if (!Hook::isModuleRegisteredOnHook($this->module, $hook_name, $this->context->shop->id)) {
                Hook::registerHook($this->module, $hook_name);
            }

            $this->module->_clearCache($this->module->templateFile);

            Tools::redirectAdmin($this->context->link->getAdminLink('Admin'.$this->name));
        } elseif (Tools::isSubmit('delete'.$this->className)) {
            if (!$this->deleteLinkList()) {
                return false;
            }

            $this->module->_clearCache($this->module->templateFile);

            Tools::redirectAdmin($this->context->link->getAdminLink('Admin'.$this->name));
        }

        return parent::postProcess();
    }
    public function initToolbarTitle()
    {
        parent::initToolbarTitle(); 

        $title = $this->Title();
        $this->toolbar_title[] = $this->l($title, null, null, false);
        $this->addMetaTitle($this->l($title, null, null, false));

    }

    public function renderView()
    {
        return Form($this->name);
    }

    public function Title(): string
    {
        return $this->name;
    }
    abstract public function Code();
    abstract public function Styles();
    abstract public function View();
}
