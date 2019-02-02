<?php
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

interface ExtensionConfiguration
{
    public function getContent(): string;
    public function displayForm(): string;
}

class Extension extends ModuleCore implements WidgetInterface
{
    public $bootstrap;
    protected $secure_key;

    public $name;
    public $version;
    public $displayName;
    public $description;
    public $author;
    public $controllers;
    public $tab;
    public $need_instance;
    public $ps_versions_compliancy;

    protected static $pages = [];
    protected static $modules = [];
    protected static $widgets = [];

    public function getWidgetVariables($hookName, array $configuration): array
    {
        return [];
    }

    public function renderWidget($hookName, array $configuration): string
    {
        $widget = substr($hookName, 6);
        $instance = new static::$widgets[$widget]();

        return $instance->Render();
    }

//    public function onInstall(): bool
//    {
//        return parent::onInstall();
//    }
//
//    public function onUninstall(): bool
//    {
//        return parent::onUninstall();
//    }
//
//    protected function addTab(string $name, string $title, string $parent = null, bool $active = true)
//    {
//        $tab = new Tab();
//        $tab->setActive($active ? 1 : 0);
//        $tab->class_name = $name;
//        $tab->name = array();
//
//        foreach (Language::getLanguages(true) as $lang) {
//            $tab->name[$lang['id_lang']] = $title;
//        }
//
//        $tab->id_parent = $parent ? (int)Tab::getIdFromClassName($parent) : 0;
//        //$tab->module = $this->name;
//        return $tab->add();
//    }
//
//    protected function removeTab(string $name)
//    {
//        $id_tab = (int)Tab::getIdFromClassName($name);
//        $tab = new Tab($id_tab);
//
//        return $tab->delete();
//    }
}
