<?php

class ShoppingcartAjaxController extends ModuleFrontController
{
    public $ssl = true;

    /**
    * @see FrontAdapter::initContent()
    */
    public function initContent()
    {
        $modal = null;

        if (Tools::getValue('action') === 'add-to-cart') {
            $modal = $this->module->renderModal(
                $this->context->cart,
                Tools::getValue('id_product'),
                Tools::getValue('id_product_attribute')
            );
        }

        ob_end_clean();
        header('Content-Type: application/json');
        die(json_encode([
            'preview' => $this->module->renderWidget(null, ['cart' => $this->context->cart]),
            'modal'   => $modal
        ]));
    }
}
