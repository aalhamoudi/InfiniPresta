<?php

include __DIR__ .'/../../config/config.inc.php';
include __DIR__ .'/FacetedSearch.php';

if (substr(Tools::encrypt('ps_facetedsearch/index'), 0, 10) != Tools::getValue('token') || !Module::isInstalled('ps_facetedsearch')) {
    die('Bad token');
}

if (!Tools::getValue('ajax')) {
    // Case of nothing to do but showing a message (1)
    if (Tools::getValue('return_message') !== false) {
        echo '1';
        die();
    }

    Tools::usingSecureMode()? $domain = Tools::getShopDomainSsl(true) : $domain = Tools::getShopDomain(true);
    // Return a content without waiting the end of index execution
    header('Location: '.$domain.__PS_BASE_URI__.'modules/FacetedSearch/FacetedSearchPriceIndexer.php?token='.Tools::getValue('token').'&return_message='.(int) Tools::getValue('cursor'));
    flush();
}

if (Tools::getValue('full'))
    echo FacetedSearch::fullPricesIndexProcess((int) Tools::getValue('cursor'), (int) Tools::getValue('ajax'), true);

else
    echo FacetedSearch::pricesIndexProcess((int) Tools::getValue('cursor'), (int) Tools::getValue('ajax'));


