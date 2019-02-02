<?php

class UIData {
    public $module;

    public function __construct($module) {
        $this->module = $module;
    }

    public function getData($hookName = null, array $configuration = [])
    {
        $vars;

        switch ($hookName) {
            case "displayCurrencySelector":
                $vars = $this->getCurrencySelectorData($hookName, $configuration);
                break;
            case "displayLanguageSelector":
                $vars = $this->getLanguageSelectorData($hookName, $configuration);
                break;
            case "displaySignIn":
                $vars = $this->getSignInData($hookName, $configuration);
                break;
            case "displaySubscription":
                $vars = [
                    'schemaurl' => '/shop/modules/ui/schema/subscription.json',
                    'endpoint' => '/shop/modules/ui/api/subscription.php'
                ];
                break;
            case "displayInformation":
                $vars = [
                    'title' => 'Information',
                    'description' => 'Some info about our store.'
                ];
                break;
            case "displayLinks":
                $vars = [];
                break;
            case "displayLocation":
                $vars = [
                    'title' => 'Location',
                    'address' => 'Our address.'
                ];
                break;
            case "displayCopyright":
                $vars = [
                    'owner' => Configuration::get('PS_SHOP_NAME'),
                    'developer' => "Infinitivity"
                ];
                break;
            default:
                $vars = [];
        }

        return $vars;
    }

    
    public function getCurrencySelectorData($hookName, array $configuration)
    {
        $current_currency = null;
        $serializer = new ObjectPresenter;
        $currencies = array_map(
            function ($currency) use ($serializer, &$current_currency) {
                $currencyArray = $serializer->present($currency);

                // serializer doesn't see 'sign' because it is not a regular
                // ObjectModel field.
                $currencyArray['sign'] = $currency->sign;

                $url = $this->context->link->getLanguageLink($this->context->language->id);

                $extraParams = array(
                    'SubmitCurrency' => 1,
                    'id_currency' => $currency->id
                );

                $partialQueryString = http_build_query($extraParams);
                $separator = empty(parse_url($url)['query']) ? '?' : '&';

                $url .= $separator . $partialQueryString;

                $currencyArray['url'] = $url;

                if ($currency->id === $this->context->currency->id) {
                    $currencyArray['current'] = true;
                    $current_currency = $currencyArray;
                } else {
                    $currencyArray['current'] = false;
                }

                return $currencyArray;
            },
            Currency::getCurrencies(true, true)
        );

        return array(
            'currencies' => $currencies,
            'current_currency' => $current_currency
        );
    }

    public function getLanguageSelectorData($hookName = null, array $configuration = [])
    {
        $languages = Language::getLanguages(true, $this->context->shop->id);

        foreach ($languages as &$lang) {
            $lang['name_simple'] = $this->getNameSimple($lang['name']);
        }

        return array(
            'languages' => $languages,
            'current_language' => array(
                'id_lang' => $this->context->language->id,
                'name' => $this->context->language->name,
                'name_simple' => $this->getNameSimple($this->context->language->name)
            )
        );
    }

    public function getSignInData($hookName = null, array $configuration = [])
    {
        $logged = $this->context->customer->isLogged();

        if ($logged) {
            $customerName = $this->getTranslator()->trans(
                '%firstname% %lastname%',
                array(
                    '%firstname%' => $this->context->customer->firstname,
                    '%lastname%' => $this->context->customer->lastname,
                ),
                'Modules.Customersignin.Admin'
            );
        } else {
            $customerName = '';
        }

        $link = $this->context->link;

        return array(
            'logged' => $logged,
            'customerName' => $customerName,
            'logout_url' => $link->getPageLink('index', true, null, 'mylogout'),
            'my_account_url' => $link->getPageLink('my-account', true),

        );
    }


    public function getShoppingCartData($hookName, array $params)
    {
        $cart_url = $this->getCartSummaryURL();

        return array(
            'cart' => (new CartPresenter)->present(isset($params['cart']) ? $params['cart'] : $this->context->cart),
            'refresh_url' => $this->context->link->getModuleLink('shoppingcart', 'ajax', array(), null, null, null, true),
            'cart_url' => $cart_url
        );
    }

    public function getSearchbarData($hookName, array $configuration = [])
    {
        $widgetData = array(
            'search_controller_url' => $this->context->link->getPageLink('search', null, null, null, false, null, true),
        );

        if (!array_key_exists('search_string', $this->context->smarty->getTemplateVars())) {
            $widgetData['search_string'] = '';
        }

        return $widgetData;
    }

    public function getContactInfoData($hookName = null, array $configuration = [])
    {
        $address = $this->context->shop->getAddress();

        $contact_infos = [
            'company' => Configuration::get('PS_SHOP_NAME'),
            'address' => [
                'formatted' => AddressFormat::generateAddress($address, array(), '<br />'),
                'address1' => $address->address1,
                'address2' => $address->address2,
                'postcode' => $address->postcode,
                'city' => $address->city,
                'state' => (new State($address->id_state))->name[$this->context->language->id],
                'country' => (new Country($address->id_country))->name[$this->context->language->id],
            ],
            'phone' => Configuration::get('PS_SHOP_PHONE'),
            'fax' => Configuration::get('PS_SHOP_FAX'),
            'email' => Configuration::get('PS_SHOP_EMAIL'),
        ];

        return [
            'contact_infos' => $contact_infos,
        ];
    }

    public function getShareButtonsData($hookName, array $params)
    {
        if (!method_exists($this->context->controller, 'getProduct')) {
            return;
        }

        $product = $this->context->controller->getProduct();

        if (!Validate::isLoadedObject($product)) {
            return;
        }

        $social_share_links = [];
        $sharing_url = addcslashes($this->context->link->getProductLink($product), "'");
        $sharing_name = addcslashes($product->name, "'");

        $image_cover_id = $product->getCover($product->id);
        if (is_array($image_cover_id) && isset($image_cover_id['id_image'])) {
            $image_cover_id = (int)$image_cover_id['id_image'];
        } else {
            $image_cover_id = 0;
        }

        $sharing_img = addcslashes($this->context->link->getImageLink($product->link_rewrite, $image_cover_id), "'");

        if (Configuration::get('PS_SC_FACEBOOK')) {
            $social_share_links['facebook'] = array(
                'label' => $this->trans('Share', array(), 'Modules.Sharebuttons.Shop'),
                'class' => 'facebook',
                'url' => 'http://www.facebook.com/sharer.php?u='.$sharing_url,
            );
        }

        if (Configuration::get('PS_SC_TWITTER')) {
            $social_share_links['twitter'] = array(
                'label' => $this->trans('Tweet', array(), 'Modules.Sharebuttons.Shop'),
                'class' => 'twitter',
                'url' => 'https://twitter.com/intent/tweet?text='.$sharing_name.' '.$sharing_url,
            );
        }

        if (Configuration::get('PS_SC_GOOGLE')) {
            $social_share_links['googleplus'] = array(
                'label' => $this->trans('Google+', array(), 'Modules.Sharebuttons.Shop'),
                'class' => 'googleplus',
                'url' => 'https://plus.google.com/share?url='.$sharing_url,
            );
        }

        if (Configuration::get('PS_SC_PINTEREST')) {
            $social_share_links['pinterest'] = array(
                'label' => $this->trans('Pinterest', array(), 'Modules.Sharebuttons.Shop'),
                'class' => 'pinterest',
                'url' => 'http://www.pinterest.com/pin/create/button/?media='.$sharing_img.'&url='.$sharing_url,
            );
        }

        return array(
            'social_share_links' => $social_share_links,
        );
    }

    public function getFeaturedProductsData($hookName = null, array $configuration = [])
    {
        $products = $this->getProducts();

        if (!empty($products)) {
            return array(
                'products' => $products,
                'allProductsLink' => Context::getContext()->link->getCategoryLink($this->getConfigFieldsValues()['HOME_FEATURED_CAT']),
            );
        }
        return false;
    }

    public function getReassuranceData($hookName = null, array $configuration = [])
    {
        $elements = $this->getListContent($this->context->language->id);

        foreach ($elements as &$element) {
            $element['image'] = $this->getImageURL($element['file_name']);
        }

        return array(
            'elements' => $elements,
        );
    }

    public function getCategoryTreeData($hookName = null, array $configuration = [])
    {
        $category = new Category((int)Configuration::get('PS_HOME_CATEGORY'), $this->context->language->id);

        if (Configuration::get('BLOCK_CATEG_ROOT_CATEGORY') && isset($this->context->cookie->last_visited_category) && $this->context->cookie->last_visited_category) {
            $category = new Category($this->context->cookie->last_visited_category, $this->context->language->id);
            if (Configuration::get('BLOCK_CATEG_ROOT_CATEGORY') == 2 && !$category->is_root_category && $category->id_parent) {
                $category = new Category($category->id_parent, $this->context->language->id);
            } elseif (Configuration::get('BLOCK_CATEG_ROOT_CATEGORY') == 3 && !$category->is_root_category && !$category->getSubCategories($category->id, true)) {
                $category = new Category($category->id_parent, $this->context->language->id);
            }
        }

        return [
            'categories' => $this->getCategories($category),
            'currentCategory' => $category->id,
        ];
    }
}