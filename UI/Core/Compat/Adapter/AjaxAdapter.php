<?php

namespace Infini;

class AjaxAdapter extends ModuleFrontController
{
	public function initContent()
	{
		parent::initContent();
		die(JSON::Encode($this->Data()));
	}

	abstract public function Data();
}

include_once '/config/config.inc.php';
include_once '/init.php';

if (Tools::getValue('data'))
{

    switch(Tools::getValue('data')) {
        case 'key':
            Response($ui->secure_key);
            break;
        default:
            die(1);
    }
}

elseif (Tools::getValue('action'))
{
    if (Tools::isSubmit('secure_key') && Tools::getValue('secure_key') == $ui->secure_key) {

    }
    else
        die(1);
}

else
    Response("Hi");



