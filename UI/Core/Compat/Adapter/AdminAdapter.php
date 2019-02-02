<?php

namespace Infini;

class AdminAdapter extends ModuleAdminController
{
    //public $className = 'LinkBlock';
    protected $name;
    protected $title;
    protected $repository;
    
    protected $sections;

    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view';

        parent::__construct();

        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }

        $this->addCss('/shop/assets/kit.css');
        $this->addJs('/shop/assets/infini.js');
    }

    public function init()
    {
        parent::init();
    }

    public function initContent() 
    {
        parent::initContent();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('action')) {
            switch (Tools::getValue('action')) {
                case 'updatePositions':
                    $this->updatePositions();
                    break;
            }
        }
        elseif (Tools::isSubmit('submit'.$this->className)) {
            if (!$this->manageLinkList()) {
                return false;
            }

            $hook_name = Hook::getNameById(Tools::getValue('id_hook'));
            if (!Hook::isModuleRegisteredOnHook($this->module, $hook_name, $this->context->shop->id)) {
                Hook::registerHook($this->module, $hook_name);
            }

            $this->module->_clearCache($this->module->templateFile);

            Tools::redirectAdmin($this->context->link->getAdminLink('Admin'.$this->name));
        }
        elseif (Tools::isSubmit('delete'.$this->className)) {
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

        $this->toolbar_title[] = $this->l($this->title, null, null, false);
        $this->addMetaTitle($this->l($this->title, null, null, false));

    }

    public function renderView()
    {
        return View($this->sections);
    }
}
