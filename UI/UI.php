<?php

use Database;
use Tools;
use PrestaShop\PrestaShop\Adapter\Configuration;

defined('_PS_VERSION_') || exit;

include_once 'Core/Core.php';

class UI extends Ext
{
    protected static $base = 'CUSTOMIZE';

    protected static $pages = [
            'AdminUIInformation' => 'Information',
            'AdminUILinks' => 'Links',
            'AdminUIBlocks' => 'Custom Blocks',
            'AdminUISliders' => 'Image Sliders',
            'AdminUIBanners' => 'Banners'
    ];

    protected static $modules = [
        'FeaturedProducts' => [
            'Hooks' => ['addProduct', 'updateProduct', 'deleteProduct', 'categoryUpdate', 'displayHome', 'displayOrderConfirmation2', 'displayCrossSellingShoppingCart', 'actionAdminGroupsControllerSaveAfter'],
            'Config' => [],
            'Tables' => []
        ]
    ];

    protected static $networks = ['Facebook', 'Twitter', 'Google', 'Pinterest'];

    public function __construct()
    {
        $this->name = 'ui';
        $this->author = 'Infinitivity';
        $this->version = '1.0.0';

        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('UI', array(), 'Modules.UI.Admin');
        $this->description = $this->trans('Allows you to display custom ui.', array(), 'Modules.UI.Admin');
        $this->tab = 'front_office_features';
        $this->ps_versions_compliancy = array('min' => '1.7.5.0', 'max' => _PS_VERSION_);

        $this->secure_key = Tools::encrypt($this->name);
        //$this->controllers = array('ajax');

    }

   
//    public function onInstall(): bool
//    {
//        $this->_clearCache('*');
//
//        $moduleHooks = [ 'displayUi', 'displayShareButtons'];
//        $featuredProductsHooks = ['addproduct', 'updateproduct', 'deleteproduct', 'categoryUpdate', 'displayHome', 'displayOrderConfirmation2', 'displayCrossSellingShoppingCart', 'actionAdminGroupsControllerSaveAfter'];
//        $searchbarHooks = ['top', 'displaySearch', 'header'];
//        $shoppingcartHooks = ['header', 'displayTop'];
//        $contactinfoHooks = ['displayNav', 'displayNav1', 'displayFooter', 'actionAdminStoresControllerUpdate_optionsAfter'];
//        $reassuranceHooks = ['displayOrderConfirmation2', 'actionUpdateLangAfter'];
//        $categorytreeHooks = ['displayLeftColumn'];
//        $currenciesHooks = ['actionAdminCurrenciesControllerSaveAfter'];
//
//        $hooks = array_merge($moduleHooks, $featuredProductsHooks, $searchbarHooks, $shoppingcartHooks, $contactinfoHooks, $reassuranceHooks, $categorytreeHooks, $currenciesHooks);
//
//        return parent::onInstall()
//            && $this->installTab()
//            && $this->registerHook($hooks);
//
//    }
//
//    public function onUninstall(): bool
//    {
//        $this->_clearCache('*');
//
//        return parent::onUninstall()
//            && $this->uninstallTab();
//
//    }

//    public function installTab()
//    {
//        $res = $this->addTab($this->base, $this->base);
//        foreach ($this->pages as $page=>$description)
//            $res = $res && $this->addTab($page, $description, $base);
//
//        return $res;
//    }
//
//    public function uninstallTab()
//    {
//        $res = true;
//        foreach ($this->pages as $pages=>$description)
//            $res = $res && $this->deleteTab($page);
//
//        return $res && $this->deleteTab($this->base);
//    }
//
//    public function installDB()
//    {
//        // Reassurance
//        $return = true;
//        $return &= Db::getInstance()->execute('
//            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'reassurance` (
//                `id_reassurance` INT UNSIGNED NOT NULL AUTO_INCREMENT,
//                `id_shop` int(10) unsigned NOT NULL ,
//                `file_name` VARCHAR(100) NOT NULL,
//                PRIMARY KEY (`id_reassurance`)
//            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
//
//        $return &= Db::getInstance()->execute('
//            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'reassurance_lang` (
//                `id_reassurance` INT UNSIGNED NOT NULL AUTO_INCREMENT,
//                `id_lang` int(10) unsigned NOT NULL ,
//                `text` VARCHAR(300) NOT NULL,
//                PRIMARY KEY (`id_reassurance`, `id_lang`)
//            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
//
//        return $return;
//    }
//
//    public function uninstallDB(): bool
//    {
//        // Reassurance
//        return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'reassurance`') && Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'reassurance_lang`');
//    }
//
//    public function addToDB()
//    {
//        // Reassurance
//
//        if (isset($_POST['nbblocks'])) {
//            for ($i = 1; $i <= (int)$_POST['nbblocks']; $i++) {
//                $filename = explode('.', $_FILES['info'.$i.'_file']['name']);
//                if (isset($_FILES['info'.$i.'_file']) && isset($_FILES['info'.$i.'_file']['tmp_name']) && !empty($_FILES['info'.$i.'_file']['tmp_name'])) {
//                    if ($error = ImageManager::validateUpload($_FILES['info'.$i.'_file'])) {
//                        return false;
//                    } elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['info'.$i.'_file']['tmp_name'], $tmpName)) {
//                        return false;
//                    } elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/'.$filename[0].'.jpg')) {
//                        return false;
//                    }
//                    unlink($tmpName);
//                }
//                Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'reassurance` (`filename`,`text`)
//                                            VALUES ("'.((isset($filename[0]) && $filename[0] != '') ? pSQL($filename[0]) : '').
//                    '", "'.((isset($_POST['info'.$i.'_text']) && $_POST['info'.$i.'_text'] != '') ? pSQL($_POST['info'.$i.'_text']) : '').'")');
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function removeFromDB()
//    {
//        // Reassurance
//        $dir = opendir(dirname(__FILE__).'/img');
//        while (false !== ($file = readdir($dir))) {
//            $path = dirname(__FILE__).'/img/'.$file;
//            if ($file != '..' && $file != '.' && !is_dir($file)) {
//                unlink($path);
//            }
//        }
//        closedir($dir);
//
//        return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'reassurance`');
//    }
//
//    protected function UpdateConfig(): bool
//    {
//        // Shopping Cart
//        Configuration::updateValue('PS_BLOCK_CART_AJAX', 1);
//
//        // Featured Products
//        Configuration::updateValue('HOME_FEATURED_NBR', 8);
//        Configuration::updateValue('HOME_FEATURED_CAT', (int) Context::getContext()->shop->getCategory());
//        Configuration::updateValue('HOME_FEATURED_RANDOMIZE', false);
//
//        // Reassurance
//        Configuration::updateValue('BLOCKREASSURANCE_NBBLOCKS', 5);
//
//        // Category Tree
//        Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', 4);
//        Configuration::updateValue('BLOCK_CATEG_ROOT_CATEGORY', 1);
//
//        // Share Buttons
//        return Configuration::updateValue('PS_SC_TWITTER', 1)
//            && Configuration::updateValue('PS_SC_FACEBOOK', 1)
//            && Configuration::updateValue('PS_SC_GOOGLE', 1)
//            && Configuration::updateValue('PS_SC_PINTEREST', 1);
//    }
//
//
//    protected function DeleteConfig() {
//        // Reassurance
//        Configuration::deleteByName('BLOCKREASSURANCE_NBBLOCKS');
//
//        // Category Tree
//        Configuration::deleteByName('BLOCK_CATEG_MAX_DEPTH');
//        Configuration::deleteByName('BLOCK_CATEG_ROOT_CATEGORY');
//    }

//    /* Get Config */
//    public function getShoppingCartConfigFieldsValues()
//    {
//        return [
//            'PS_BLOCK_CART_AJAX' => (bool)Tools::getValue('PS_BLOCK_CART_AJAX', Configuration::get('PS_BLOCK_CART_AJAX')),
//        ];
//    }
//
//    public function getShareButtonsConfigFieldsValues()
//    {
//        $values = array();
//
//        foreach (self::$networks as $network) {
//            $values['PS_SC_'.Tools::strtoupper($network)] = (int)Tools::getValue('PS_SC_'.Tools::strtoupper($network), Configuration::get('PS_SC_'.Tools::strtoupper($network)));
//        }
//
//        return $values;
//    }
//
//    // Featured Products
//    public function getFeaturedProductsConfigFieldsValues()
//    {
//        return array(
//            'HOME_FEATURED_NBR' => Tools::getValue('HOME_FEATURED_NBR', (int) Configuration::get('HOME_FEATURED_NBR')),
//            'HOME_FEATURED_CAT' => Tools::getValue('HOME_FEATURED_CAT', (int) Configuration::get('HOME_FEATURED_CAT')),
//            'HOME_FEATURED_RANDOMIZE' => Tools::getValue('HOME_FEATURED_RANDOMIZE', (bool) Configuration::get('HOME_FEATURED_RANDOMIZE')),
//        );
//    }
//
//    public function getCategoryTreeConfigFieldsValues()
//    {
//        return array(
//            'BLOCK_CATEG_MAX_DEPTH' => Tools::getValue('BLOCK_CATEG_MAX_DEPTH', Configuration::get('BLOCK_CATEG_MAX_DEPTH')),
//            'BLOCK_CATEG_SORT_WAY' => Tools::getValue('BLOCK_CATEG_SORT_WAY', Configuration::get('BLOCK_CATEG_SORT_WAY')),
//            'BLOCK_CATEG_SORT' => Tools::getValue('BLOCK_CATEG_SORT', Configuration::get('BLOCK_CATEG_SORT')),
//            'BLOCK_CATEG_ROOT_CATEGORY' => Tools::getValue('BLOCK_CATEG_ROOT_CATEGORY', Configuration::get('BLOCK_CATEG_ROOT_CATEGORY'))
//        );
//    }
//
    /* Content */
    public function getContent()
    {
        return  $this->context->link->getModuleLink('ui', 'display');
    }

//    public function getShoppingCartContent()
//    {
//        $output = '';
//        if (Tools::isSubmit('submitBlockCart')) {
//            $ajax = Tools::getValue('PS_BLOCK_CART_AJAX');
//            if ($ajax != 0 && $ajax != 1) {
//                $output .= $this->displayError($this->trans('Ajax: Invalid choice.', array(), 'Modules.Shoppingcart.Admin'));
//            } else {
//                Configuration::updateValue('PS_BLOCK_CART_AJAX', (int)($ajax));
//            }
//        }
//        return $output.$this->renderShoppingCartForm();
//    }

//    public function getShareButtonsContent()
//    {
//        $output = '';
//        if (Tools::isSubmit('submitSocialSharing')) {
//            foreach (self::$networks as $network) {
//                Configuration::updateValue('PS_SC_'.Tools::strtoupper($network), (int)Tools::getValue('PS_SC_'.Tools::strtoupper($network)));
//            }
//
//            $this->_clearCache($this->templateFile);
//
//            $output .= $this->displayConfirmation($this->trans('Settings updated.', array(), 'Admin.Notifications.Success'));
//
//            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=6&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
//        }
//
//        $helper = new HelperForm();
//        $helper->submit_action = 'submitSocialSharing';
//        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
//        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        $helper->tpl_vars = array('fields_value' => $this->getConfigFieldsValues());
//
//        $fields = array();
//        foreach (self::$networks as $network) {
//            $fields[] = array(
//                'type' => 'switch',
//                'label' => $network,
//                'name' => 'PS_SC_'.Tools::strtoupper($network),
//                'values' => array(
//                    array(
//                        'id' => Tools::strtolower($network).'_active_on',
//                        'value' => 1,
//                        'label' => $this->trans('Enabled', array(), 'Admin.Global')
//                    ),
//                    array(
//                        'id' => Tools::strtolower($network).'_active_off',
//                        'value' => 0,
//                        'label' => $this->trans('Disabled', array(), 'Admin.Global')
//                    )
//                )
//            );
//        }
//
//        return $output.$helper->generateForm(array(
//            array(
//                'form' => array(
//                    'legend' => array(
//                        'title' => $this->displayName,
//                        'icon' => 'icon-share'
//                    ),
//                    'input' => $fields,
//                    'submit' => array(
//                        'title' => $this->trans('Save', array(), 'Admin.Actions')
//                    )
//                )
//            )
//        ));
//    }
//
//    public function getFeaturedProductsContent()
//    {
//        $output = '';
//        $errors = array();
//
//        if (Tools::isSubmit('submitHomeFeatured')) {
//            $nbr = Tools::getValue('HOME_FEATURED_NBR');
//            if (!Validate::isInt($nbr) || $nbr <= 0) {
//                $errors[] = $this->trans('The number of products is invalid. Please enter a positive number.', array(), 'Modules.Featuredproducts.Admin');
//            }
//
//            $cat = Tools::getValue('HOME_FEATURED_CAT');
//            if (!Validate::isInt($cat) || $cat <= 0) {
//                $errors[] = $this->trans('The category ID is invalid. Please choose an existing category ID.', array(), 'Modules.Featuredproducts.Admin');
//            }
//
//            $rand = Tools::getValue('HOME_FEATURED_RANDOMIZE');
//            if (!Validate::isBool($rand)) {
//                $errors[] = $this->trans('Invalid value for the "randomize" flag.', array(), 'Modules.Featuredproducts.Admin');
//            }
//            if (isset($errors) && count($errors)) {
//                $output = $this->displayError(implode('<br />', $errors));
//            } else {
//                Configuration::updateValue('HOME_FEATURED_NBR', (int) $nbr);
//                Configuration::updateValue('HOME_FEATURED_CAT', (int) $cat);
//                Configuration::updateValue('HOME_FEATURED_RANDOMIZE', (bool) $rand);
//
//                $this->_clearCache('*');
//
//                $output = $this->displayConfirmation($this->trans('The settings have been updated.', array(), 'Admin.Notifications.Success'));
//            }
//        }
//
//        return $output.$this->renderForm();
//    }
//
//    public function getReassuranceContent()
//    {
//        $html = '';
//        $id_reassurance = (int)Tools::getValue('id_reassurance');
//
//        if (Tools::isSubmit('saveblockreassurance')) {
//            if ($id_reassurance = Tools::getValue('id_reassurance')) {
//                $reassurance = new reassuranceClass((int)$id_reassurance);
//            } else {
//                $reassurance = new reassuranceClass();
//            }
//
//            $reassurance->copyFromPost();
//            $reassurance->id_shop = $this->context->shop->id;
//
//            if ($reassurance->validateFields(false) && $reassurance->validateFieldsLang(false)) {
//                $reassurance->save();
//
//                if (isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
//                    if ($error = ImageManager::validateUpload($_FILES['image'])) {
//                        return false;
//                    } elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName)) {
//                        return false;
//                    } elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/reassurance-'.(int)$reassurance->id.'-'.(int)$reassurance->id_shop.'.jpg')) {
//                        return false;
//                    }
//
//                    unlink($tmpName);
//                    $reassurance->file_name = 'reassurance-'.(int)$reassurance->id.'-'.(int)$reassurance->id_shop.'.jpg';
//                    $reassurance->save();
//                }
//                $this->_clearCache('*');
//            } else {
//                $html .= '<div class="conf error">'.$this->trans('An error occurred while attempting to save.', array(), 'Admin.Notifications.Error').'</div>';
//            }
//        }
//
//        if (Tools::isSubmit('updateblockreassurance') || Tools::isSubmit('addblockreassurance')) {
//            $helper = $this->initForm();
//            foreach (Language::getLanguages(false) as $lang) {
//                if ($id_reassurance) {
//                    $reassurance = new reassuranceClass((int)$id_reassurance);
//                    $helper->fields_value['text'][(int)$lang['id_lang']] = $reassurance->text[(int)$lang['id_lang']];
//                    $image = dirname(__FILE__).DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$reassurance->file_name;
//                    $this->fields_form[0]['form']['input'][0]['image'] = '<img src="'.$this->getImageURL($reassurance->file_name).'" />';
//                } else {
//                    $helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], '');
//                }
//            }
//            if ($id_reassurance = Tools::getValue('id_reassurance')) {
//                $this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_reassurance');
//                $helper->fields_value['id_reassurance'] = (int)$id_reassurance;
//            }
//
//            return $html.$helper->generateForm($this->fields_form);
//        } elseif (Tools::isSubmit('deleteblockreassurance')) {
//            $reassurance = new reassuranceClass((int)$id_reassurance);
//            if (file_exists(dirname(__FILE__).'/img/'.$reassurance->file_name)) {
//                unlink(dirname(__FILE__).'/img/'.$reassurance->file_name);
//            }
//            $reassurance->delete();
//            $this->_clearCache('*');
//            Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
//        } else {
//            $content = $this->getListContent((int)Configuration::get('PS_LANG_DEFAULT'));
//            $helper = $this->initList();
//            $helper->listTotal = count($content);
//            return $html.$helper->generateList($content, $this->fields_list);
//        }
//
//        if (isset($_POST['submitModule'])) {
//            Configuration::updateValue('BLOCKREASSURANCE_NBBLOCKS', ((isset($_POST['nbblocks']) && $_POST['nbblocks'] != '') ? (int)$_POST['nbblocks'] : ''));
//            if ($this->removeFromDB() && $this->addToDB()) {
//                $this->_clearCache('blockreassurance.tpl');
//                $output = '<div class="conf confirm">'.$this->trans('The block configuration has been updated.', array(), 'Modules.Blockreassurance.Admin').'</div>';
//            } else {
//                $output = '<div class="conf error"><img src="../img/admin/disabled.gif"/>'.$this->trans('An error occurred while attempting to save.', array(), 'Admin.Notifications.Error').'</div>';
//            }
//        }
//    }
//
//    public function getCategoryTreeContent()
//    {
//        $output = '';
//        if (Tools::isSubmit('submitBlockCategories')) {
//            $maxDepth = (int)(Tools::getValue('BLOCK_CATEG_MAX_DEPTH'));
//            if ($maxDepth < 0) {
//                $output .= $this->displayError($this->getTranslator()->trans('Maximum depth: Invalid number.', array(), 'Admin.Notifications.Error'));
//            } else {
//                Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', (int)$maxDepth);
//                Configuration::updateValue('BLOCK_CATEG_SORT_WAY', Tools::getValue('BLOCK_CATEG_SORT_WAY'));
//                Configuration::updateValue('BLOCK_CATEG_SORT', Tools::getValue('BLOCK_CATEG_SORT'));
//                Configuration::updateValue('BLOCK_CATEG_ROOT_CATEGORY', Tools::getValue('BLOCK_CATEG_ROOT_CATEGORY'));
//
//                //$this->_clearBlockcategoriesCache();
//
//                Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=6');
//            }
//        }
//        return $output.$this->renderForm();
//    }
//
//    /* Render Forms */
//    public function renderShoppingCartForm()
//    {
//        $fields_form = array(
//            'form' => array(
//                'legend' => array(
//                    'title' => $this->trans('Settings', array(), 'Admin.Global'),
//                    'icon' => 'icon-cogs',
//                ),
//                'input' => array(
//                    array(
//                        'type' => 'switch',
//                        'label' => $this->trans('Ajax cart', array(), 'Modules.Shoppingcart.Admin'),
//                        'name' => 'PS_BLOCK_CART_AJAX',
//                        'is_bool' => true,
//                        'desc' => $this->trans('Activate Ajax mode for the cart (compatible with the default theme).', array(), 'Modules.Shoppingcart.Admin'),
//                        'values' => array(
//                            array(
//                                'id' => 'active_on',
//                                'value' => 1,
//                                'label' => $this->trans('Enabled', array(), 'Admin.Global'),
//                            ),
//                            array(
//                                'id' => 'active_off',
//                                'value' => 0,
//                                'label' => $this->trans('Disabled', array(), 'Admin.Global'),
//                            )
//                        ),
//                    ),
//                ),
//                'submit' => array(
//                    'title' => $this->trans('Save', array(), 'Admin.Actions'),
//                ),
//            ),
//        );
//
//        $helper = new HelperForm();
//        $helper->show_toolbar = false;
//        $helper->table =  $this->table;
//        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
//        $helper->default_form_language = $lang->id;
//        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
//        $this->fields_form = array();
//
//        $helper->identifier = $this->identifier;
//        $helper->submit_action = 'submitBlockCart';
//        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab
//        .'&module_name='.$this->name;
//        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        $helper->tpl_vars = array(
//            'fields_value' => $this->getConfigFieldsValues(),
//            'languages' => $this->context->controller->getLanguages(),
//            'id_language' => $this->context->language->id
//        );
//
//        return $helper->generateForm(array($fields_form));
//    }
//
//    public function renderFeaturedProductsForm()
//    {
//        $fields_form = array(
//            'form' => array(
//                'legend' => array(
//                    'title' => $this->trans('Settings', array(), 'Admin.Global'),
//                    'icon' => 'icon-cogs',
//                ),
//
//                'description' => $this->trans('To add products to your homepage, simply add them to the corresponding product category (default: "Home").', array(), 'Modules.Featuredproducts.Admin'),
//                'input' => array(
//                    array(
//                        'type' => 'text',
//                        'label' => $this->trans('Number of products to be displayed', array(), 'Modules.Featuredproducts.Admin'),
//                        'name' => 'HOME_FEATURED_NBR',
//                        'class' => 'fixed-width-xs',
//                        'desc' => $this->trans('Set the number of products that you would like to display on homepage (default: 8).', array(), 'Modules.Featuredproducts.Admin'),
//                    ),
//                    array(
//                        'type' => 'text',
//                        'label' => $this->trans('Category from which to pick products to be displayed', array(), 'Modules.Featuredproducts.Admin'),
//                        'name' => 'HOME_FEATURED_CAT',
//                        'class' => 'fixed-width-xs',
//                        'desc' => $this->trans('Choose the category ID of the products that you would like to display on homepage (default: 2 for "Home").', array(), 'Modules.Featuredproducts.Admin'),
//                    ),
//                    array(
//                        'type' => 'switch',
//                        'label' => $this->trans('Randomly display featured products', array(), 'Modules.Featuredproducts.Admin'),
//                        'name' => 'HOME_FEATURED_RANDOMIZE',
//                        'class' => 'fixed-width-xs',
//                        'desc' => $this->trans('Enable if you wish the products to be displayed randomly (default: no).', array(), 'Modules.Featuredproducts.Admin'),
//                        'values' => array(
//                            array(
//                                'id' => 'active_on',
//                                'value' => 1,
//                                'label' => $this->trans('Yes', array(), 'Admin.Global'),
//                            ),
//                            array(
//                                'id' => 'active_off',
//                                'value' => 0,
//                                'label' => $this->trans('No', array(), 'Admin.Global'),
//                            ),
//                        ),
//                    ),
//                ),
//                'submit' => array(
//                    'title' => $this->trans('Save', array(), 'Admin.Actions'),
//                ),
//            ),
//        );
//
//        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
//
//        $helper = new HelperForm();
//        $helper->show_toolbar = false;
//        $helper->table = $this->table;
//        $helper->default_form_language = $lang->id;
//        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
//        $helper->id = (int) Tools::getValue('id_carrier');
//        $helper->identifier = $this->identifier;
//        $helper->submit_action = 'submitHomeFeatured';
//        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
//        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        $helper->tpl_vars = array(
//            'fields_value' => $this->getConfigFieldsValues(),
//            'languages' => $this->context->controller->getLanguages(),
//            'id_language' => $this->context->language->id,
//        );
//
//        return $helper->generateForm(array($fields_form));
//    }
//
//
//
//    /* Render Widget */
//
//    public function renderWidget($hookName = null, array $configuration = [])
//    {
//        if ($hookName == null && isset($configuration['hook'])) {
//            $hookName = $configuration['hook'];
//        }
//
//
//
//        switch ($hookName) {
//            case "displayCurrencySelector":
//                return $this->Widget("currencyselector", $this->getWidgetVariables($hookName, $configuration));
//            case "displayLanguageSelector":
//                return $this->Widget("languageselector", $this->getWidgetVariables($hookName, $configuration));
//            case "displaySignIn":
//                return $this->Widget("account", $this->getWidgetVariables($hookName, $configuration));
//            case "displaySubscription":
//                return $this->Widget("newsletter", $this->getWidgetVariables($hookName, $configuration));
//            case "displayInformation":
//                return $this->Widget("information", $this->getWidgetVariables($hookName, $configuration));
//            case "displayLinks":
//                return $this->Widget("links", $this->getWidgetVariables($hookName, $configuration));
//            case "displayLocation":
//                return $this->Widget("location", $this->getWidgetVariables($hookName, $configuration));
//            case "displayCopyright":
//                return $this->Widget("copyright", $this->getWidgetVariables($hookName, $configuration));
//            case "displayShareButtons":
//                return $this->renderShareButtons($hookname);
//            default:
//                return false;
//        }
//
//        return false;
//    }
//
//    public function renderCurrencySelector($hookname, $configuration) {
//        if (!Configuration::isCatalogMode() && Currency::isMultiCurrencyActivated()) {
//            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
//            return $this->fetch('module:ui/templates/currencyselector.tpl');
//        }
//        return false;
//    }
//
//    public function renderLanguageSelector($hookname, $configuration) {
//        $languages = Language::getLanguages(true, $this->context->shop->id);
//        if (1 < count($languages)) {
//            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
//            return $this->fetch('module:ui/templates/languageselector.tpl');
//        }
//        return false;
//    }
//
//    public function renderSignIn($hookname, $configuration) {
//        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
//        return $this->fetch('module:ui/templates/signin.tpl');
//    }
//
//    public function renderShoppingCart($hookName, array $params)
//    {
//        if (Configuration::isCatalogMode()) {
//            return;
//        }
//
//        $this->smarty->assign($this->getShoppingCartVariables($hookName, $params));
//        return $this->fetch('module:ui/templates/shoppingcart.tpl');
//    }
//
//
//    public function renderSearchbar($hookName, array $configuration = [])
//    {
//        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
//
//        return $this->fetch('module:ui/templates/searchbar.tpl');
//    }
//
//    public function renderContactInfo($hookName = null, array $configuration = [])
//    {
//        $templates = array (
//            'light' => 'nav.tpl',
//            'rich' => 'ps_contactinfo-rich.tpl',
//            'default' => 'ps_contactinfo.tpl',
//        );
//
//        if ($hookName == null && isset($configuration['hook'])) {
//            $hookName = $configuration['hook'];
//        }
//
//        if (preg_match('/^displayNav\d*$/', $hookName)) {
//            $template_file = $templates['light'];
//        } elseif ($hookName == 'displayLeftColumn') {
//            $template_file = $templates['rich'];
//        } else {
//            $template_file = $templates['default'];
//        }
//
//        $this->smarty->assign($this->getContactInfoVariables($hookName, $configuration));
//
//        return $this->fetch('module:ui/templates/'.$template_file);
//    }
//
//    public function renderShareButtons($hookName, array $params)
//    {
//        $templateFile = 'module:ui/templates/sharebuttons.tpl';
//
//        $key = 'ps_sharebuttons|' . $params['product']['id_product'];
//        if (!empty($params['product']['id_product_attribute'])) {
//            $key .= '|' . $params['product']['id_product_attribute'];
//        }
//
//        if (!$this->isCached($templateFile, $this->getCacheId($key))) {
//            $this->smarty->assign($this->getShareButtonsVariables($hookName, $params));
//        }
//
//        return $this->fetch($templateFile, $this->getCacheId($key));
//    }
//
//    public function renderFeaturedProducts($hookName = null, array $configuration = [])
//    {
//        $templateFile = 'module:ui/templates/featuredproducts.tpl';
//
//        if (!$this->isCached($templateFile, $this->getCacheId('featuredproducts'))) {
//            $variables = $this->getWidgetVariables($hookName, $configuration);
//
//            if (empty($variables)) {
//                return false;
//            }
//
//            $this->smarty->assign($variables);
//        }
//
//        return $this->fetch($templateFile, $this->getCacheId('featuredproducts'));
//    }
//
//    public function renderReassurance($hookName = null, array $configuration = [])
//    {
//        $templateFile = 'module:ui/templates/reassurance.tpl';
//
//        if (!$this->isCached($templateFile, $this->getCacheId('reassurance'))) {
//            $this->smarty->assign($this->getReassuranceVariables($hookName, $configuration));
//        }
//
//        return $this->fetch($templateFile, $this->getCacheId('blockreassurance'));
//    }
//
//    public function renderCategoryTree($hookName = null, array $configuration = [])
//    {
//        $this->setLastVisitedCategory();
//        $this->smarty->assign($this->getCategoryTreeVariables($hookName, $configuration));
//
//        return $this->fetch('module:ui/templates/categorytree.tpl');
//    }
//
//
//    /* Render Modals */
//    public function renderShoppingCartModal(Cart $cart, $id_product, $id_product_attribute)
//    {
//        $data = (new CartPresenter)->present($cart);
//        $product = null;
//        foreach ($data['products'] as $p) {
//            if ($p['id_product'] == $id_product && $p['id_product_attribute'] == $id_product_attribute) {
//                $product = $p;
//                break;
//            }
//        }
//
//        $this->smarty->assign(array(
//            'product' => $product,
//            'cart' => $data,
//            'cart_url' => $this->getCartSummaryURL(),
//        ));
//
//        return $this->fetch('module:shoppingcart/modal.tpl');
//    }
//
//
//    /* Variables */
//
//    public function getWidgetVariables($hookName = null, array $configuration = [])
//    {
//        $vars;
//
//        switch ($hookName) {
//            case "displayCurrencySelector":
//                $vars = $this->getCurrencySelectorVariables($hookName, $configuration);
//                break;
//            case "displayLanguageSelector":
//                $vars = $this->getLanguageSelectorVariables($hookName, $configuration);
//                break;
//            case "displaySignIn":
//                $vars = $this->getSignInVariables($hookName, $configuration);
//                break;
//            case "displaySubscription":
//                $vars = [
//                    'schemaurl' => '/shop/modules/ui/schema/subscription.json',
//                    'endpoint' => '/shop/modules/ui/api/subscription.php'
//                ];
//                break;
//            case "displayInformation":
//                $vars = [
//                    'title' => 'Information',
//                    'description' => 'Some info about our store.'
//                ];
//                break;
//            case "displayLinks":
//                $vars = [];
//                break;
//            case "displayLocation":
//                $vars = [
//                    'title' => 'Location',
//                    'address' => 'Our address.'
//                ];
//                break;
//            case "displayCopyright":
//                $vars = [
//                    'owner' => Configuration::get('PS_SHOP_NAME'),
//                    'developer' => "Infinitivity"
//                ];
//                break;
//            default:
//                $vars = [];
//        }
//
//        return $vars;
//    }
//
//    /* Init */
//    // Reassurance
//    protected function initForm()
//    {
//        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
//
//        $this->fields_form[0]['form'] = array(
//            'legend' => array(
//                'title' => $this->trans('New reassurance block', array(), 'Modules.Blockreassurance.Admin'),
//            ),
//            'input' => array(
//                array(
//                    'type' => 'file',
//                    'label' => $this->trans('Image', array(), 'Admin.Global'),
//                    'name' => 'image',
//                    'value' => true,
//                    'display_image' => true,
//                ),
//                array(
//                    'type' => 'textarea',
//                    'label' => $this->trans('Text', array(), 'Admin.Global'),
//                    'lang' => true,
//                    'name' => 'text',
//                    'cols' => 40,
//                    'rows' => 10
//                )
//            ),
//            'submit' => array(
//                'title' => $this->trans('Save', array(), 'Admin.Actions'),
//            )
//        );
//
//        $helper = new HelperForm();
//        $helper->module = $this;
//        $helper->name_controller = 'blockreassurance';
//        $helper->identifier = $this->identifier;
//        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        foreach (Language::getLanguages(false) as $lang) {
//            $helper->languages[] = array(
//                'id_lang' => $lang['id_lang'],
//                'iso_code' => $lang['iso_code'],
//                'name' => $lang['name'],
//                'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
//            );
//        }
//
//        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
//        $helper->default_form_language = $default_lang;
//        $helper->allow_employee_form_lang = $default_lang;
//        $helper->toolbar_scroll = true;
//        $helper->title = $this->displayName;
//        $helper->submit_action = 'saveblockreassurance';
//        $helper->toolbar_btn =  array(
//            'save' =>
//            array(
//                'desc' => $this->trans('Save', array(), 'Admin.Actions'),
//                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
//            ),
//            'back' =>
//            array(
//                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
//                'desc' => $this->trans('Back to list', array(), 'Admin.Actions'),
//            )
//        );
//        return $helper;
//    }
//
//    protected function initList()
//    {
//        $this->fields_list = array(
//            'id_reassurance' => array(
//                'title' => $this->trans('ID', array(), 'Admin.Global'),
//                'width' => 120,
//                'type' => 'text',
//                'search' => false,
//                'orderby' => false
//            ),
//            'text' => array(
//                'title' => $this->trans('Text', array(), 'Admin.Global'),
//                'width' => 140,
//                'type' => 'text',
//                'search' => false,
//                'orderby' => false
//            ),
//        );
//
//        if (Shop::isFeatureActive()) {
//            $this->fields_list['id_shop'] = array(
//                'title' => $this->trans('ID Shop', array(), 'Modules.Blockreassurance.Admin'),
//                'align' => 'center',
//                'width' => 25,
//                'type' => 'int'
//            );
//        }
//
//        $helper = new HelperList();
//        $helper->shopLinkType = '';
//        $helper->simple_header = false;
//        $helper->identifier = 'id_reassurance';
//        $helper->actions = array('edit', 'delete');
//        $helper->show_toolbar = true;
//        $helper->imageType = 'jpg';
//        $helper->toolbar_btn['new'] =  array(
//            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&add'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
//            'desc' => $this->trans('Add new', array(), 'Admin.Actions')
//        );
//
//        $helper->title = $this->displayName;
//        $helper->table = $this->name;
//        $helper->token = Tools::getAdminTokenLite('AdminModules');
//        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
//        return $helper;
//    }
//
//    /* Hooks */
//
//    // Currency Selector
//    public function hookActionAdminCurrenciesControllerSaveAfter($params) {
//        return parent::_clearCache($this->templateFile);
//    }
//
//    // Searchbar
//    public function hookHeader()
//    {
//        // Shopping Cart
//        if (Configuration::isCatalogMode()) {
//            return;
//        }
//
//        if (Configuration::get('PS_BLOCK_CART_AJAX')) {
//            $this->context->controller->registerJavascript('modules-shoppingcart', 'modules/'.$this->name.'/shoppingcart.js', ['position' => 'bottom', 'priority' => 150]);
//        }
//
//        // Searchbar
//        $this->context->controller->addJqueryUI('ui.autocomplete');
//        $this->context->controller->registerJavascript('modules-searchbar', 'modules/'.$this->name.'/searchbar.js', ['position' => 'bottom', 'priority' => 150]);
//    }
//
//    // Contact Info
//    public function hookActionAdminStoresControllerUpdate_optionsAfter()
//    {
//        foreach ($this->templates as $template) {
//            $this->_clearCache($template);
//        }
//
//        return true;
//    }
//
//    // Featured Products
//    public function hookAddProduct($params)
//    {
//        $this->_clearCache('*');
//    }
//
//    public function hookUpdateProduct($params)
//    {
//        $this->_clearCache('*');
//    }
//
//    public function hookDeleteProduct($params)
//    {
//        $this->_clearCache('*');
//    }
//
//    public function hookCategoryUpdate($params)
//    {
//        $this->_clearCache('*');
//    }
//
//    public function hookActionAdminGroupsControllerSaveAfter($params)
//    {
//        $this->_clearCache('*');
//    }
//
//    // Reassurance
//    public function hookActionUpdateLangAfter($params)
//    {
//        if (!empty($params['lang']) && $params['lang'] instanceOf Language) {
//            include_once _PS_MODULE_DIR_ . $this->name . '/lang/ReassuranceLang.php';
//
//            Language::updateMultilangFromClass(_DB_PREFIX_ . 'reassurance_lang', 'ReassuranceLang', $params['lang']);
//        }
//    }
//
//    /* Data */
//    // Shopping Cart
//    private function getCartSummaryURL()
//    {
//        return $this->context->link->getPageLink(
//            'cart',
//            null,
//            $this->context->language->id,
//            array(
//                'action' => 'show'
//            ),
//            false,
//            null,
//            true
//        );
//    }
//
//    // Featured Products
//    protected function getProducts()
//    {
//        $category = new Category((int) Configuration::get('HOME_FEATURED_CAT'));
//
//        $searchProvider = new CategoryProductSearchProvider(
//            $this->context->getTranslator(),
//            $category
//        );
//
//        $context = new ProductSearchContext($this->context);
//
//        $query = new ProductSearchQuery();
//
//        $nProducts = Configuration::get('HOME_FEATURED_NBR');
//        if ($nProducts < 0) {
//            $nProducts = 12;
//        }
//
//        $query
//            ->setResultsPerPage($nProducts)
//            ->setPage(1)
//        ;
//
//        if (Configuration::get('HOME_FEATURED_RANDOMIZE')) {
//            $query->setSortOrder(SortOrder::random());
//        } else {
//            $query->setSortOrder(new SortOrder('product', 'position', 'asc'));
//        }
//
//        $result = $searchProvider->runQuery(
//            $context,
//            $query
//        );
//
//        $assembler = new ProductAssembler($this->context);
//
//        $presenterFactory = new ProductPresenterFactory($this->context);
//        $presentationSettings = $presenterFactory->getPresentationSettings();
//        $presenter = new ProductListingPresenter(
//            new ImageRetriever(
//                $this->context->link
//            ),
//            $this->context->link,
//            new PriceFormatter(),
//            new ProductColorsRetriever(),
//            $this->context->getTranslator()
//        );
//
//        $products_for_template = [];
//
//        foreach ($result->getProducts() as $rawProduct) {
//            $products_for_template[] = $presenter->present(
//                $presentationSettings,
//                $assembler->assembleProduct($rawProduct),
//                $this->context->language
//            );
//        }
//
//        return $products_for_template;
//    }
//
//    // Reassurance
//    protected function getListContent($id_lang)
//    {
//        return  Db::getInstance()->executeS('
//            SELECT r.`id_reassurance`, r.`id_shop`, r.`file_name`, rl.`text`
//            FROM `'._DB_PREFIX_.'reassurance` r
//            LEFT JOIN `'._DB_PREFIX_.'reassurance_lang` rl ON (r.`id_reassurance` = rl.`id_reassurance`)
//            WHERE `id_lang` = '.(int)$id_lang.' '.Shop::addSqlRestrictionOnLang());
//    }
//
//    // Category Tree
//    private function getCategories($category)
//    {
//        $range = '';
//        $maxdepth = Configuration::get('BLOCK_CATEG_MAX_DEPTH');
//        if (Validate::isLoadedObject($category)) {
//            if ($maxdepth > 0) {
//                $maxdepth += $category->level_depth;
//            }
//            $range = 'AND nleft >= '.(int)$category->nleft.' AND nright <= '.(int)$category->nright;
//        }
//
//        $resultIds = array();
//        $resultParents = array();
//        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
//			SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
//			FROM `'._DB_PREFIX_.'category` c
//			INNER JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.(int)$this->context->language->id.Shop::addSqlRestrictionOnLang('cl').')
//			INNER JOIN `'._DB_PREFIX_.'category_shop` cs ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = '.(int)$this->context->shop->id.')
//			WHERE (c.`active` = 1 OR c.`id_category` = '.(int)Configuration::get('PS_HOME_CATEGORY').')
//			AND c.`id_category` != '.(int)Configuration::get('PS_ROOT_CATEGORY').'
//			'.((int)$maxdepth != 0 ? ' AND `level_depth` <= '.(int)$maxdepth : '').'
//			'.$range.'
//			AND c.id_category IN (
//				SELECT id_category
//				FROM `'._DB_PREFIX_.'category_group`
//				WHERE `id_group` IN ('.pSQL(implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id))).')
//			)
//			ORDER BY `level_depth` ASC, '.(Configuration::get('BLOCK_CATEG_SORT') ? 'cl.`name`' : 'cs.`position`').' '.(Configuration::get('BLOCK_CATEG_SORT_WAY') ? 'DESC' : 'ASC'));
//        foreach ($result as &$row) {
//            $resultParents[$row['id_parent']][] = &$row;
//            $resultIds[$row['id_category']] = &$row;
//        }
//
//        return $this->getTree($resultParents, $resultIds, $maxdepth, ($category ? $category->id : null));
//    }
//
//    public function getTree($resultParents, $resultIds, $maxDepth, $id_category = null, $currentDepth = 0)
//    {
//        if (is_null($id_category)) {
//            $id_category = $this->context->shop->getCategory();
//        }
//
//        $children = [];
//
//        if (isset($resultParents[$id_category]) && count($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth)) {
//            foreach ($resultParents[$id_category] as $subcat) {
//                $children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
//            }
//        }
//
//        if (isset($resultIds[$id_category])) {
//            $link = $this->context->link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']);
//            $name = $resultIds[$id_category]['name'];
//            $desc = $resultIds[$id_category]['description'];
//        } else {
//            $link = $name = $desc = '';
//        }
//
//        return [
//            'id' => $id_category,
//            'link' => $link,
//            'name' => $name,
//            'desc'=> $desc,
//            'children' => $children
//        ];
//    }
//
//    /* Fixtures */
//    public function installReassuranceFixtures()
//    {
//        $return = true;
//        $tab_texts = array(
//            array('text' => $this->trans('Security policy (edit with Customer reassurance module)', array(), 'Modules.Blockreassurance.Shop'), 'file_name' => 'ic_verified_user_black_36dp_1x.png'),
//            array('text' => $this->trans('Delivery policy (edit with Customer reassurance module)', array(), 'Modules.Blockreassurance.Shop'), 'file_name' => 'ic_local_shipping_black_36dp_1x.png'),
//            array('text' => $this->trans('Return policy (edit with Customer reassurance module)', array(), 'Modules.Blockreassurance.Shop'), 'file_name' => 'ic_swap_horiz_black_36dp_1x.png'),
//        );
//
//        foreach ($tab_texts as $tab) {
//            $reassurance = new reassuranceClass();
//            foreach (Language::getLanguages(false) as $lang) {
//                $reassurance->text[$lang['id_lang']] = $tab['text'];
//            }
//            $reassurance->file_name = $tab['file_name'];
//            $reassurance->id_shop = $this->context->shop->id;
//            $return &= $reassurance->save();
//        }
//        return $return;
//    }
//
//    /* Utils */
//    // Language Selector
//    private function getNameSimple($name)
//    {
//        return preg_replace('/\s\(.*\)$/', '', $name);
//    }
//
//    // Featured Products
//    public function _clearCache($template, $cache_id = null, $compile_id = null)
//    {
//        parent::_clearCache($this->templateFile);
//    }
//
//    // Reassurance
//    private function getImageURL($image)
//    {
//        return $this->context->link->getMediaLink(__PS_BASE_URI__.'modules/'.$this->name.'/img/'.$image);
//    }
//
//    // Category Tree
//    public function setLastVisitedCategory()
//    {
//        if (method_exists($this->context->controller, 'getCategory') && ($category = $this->context->controller->getCategory())) {
//            $this->context->cookie->last_visited_category = $category->id;
//        } elseif (method_exists($this->context->controller, 'getProduct') && ($product = $this->context->controller->getProduct())) {
//            if (!isset($this->context->cookie->last_visited_category)
//                || !Product::idIsOnCategoryId($product->id, array(array('id_category' => $this->context->cookie->last_visited_category)))
//                || !Category::inShopStatic($this->context->cookie->last_visited_category, $this->context->shop)
//            ) {
//                $this->context->cookie->last_visited_category = (int)$product->id_category_default;
//            }
//        }
//    }*/
}
