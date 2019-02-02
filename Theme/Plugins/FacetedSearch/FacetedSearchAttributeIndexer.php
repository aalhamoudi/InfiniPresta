<?php

include __DIR__ .'/../../config/config.inc.php';
include __DIR__ .'/FacetedSearch.php';

if (substr(Tools::encrypt('ps_facetedsearch/index'), 0, 10) != Tools::getValue('token') || !Module::isInstalled('ps_facetedsearch')) {
    die('Bad token');
}

$FacetedSearch = new FacetedSearch();
echo $FacetedSearch->indexAttribute();
