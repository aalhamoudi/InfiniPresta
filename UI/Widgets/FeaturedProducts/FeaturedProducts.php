<?php
namespace Infini;

use Module;

class FeaturedProducts extends Module {
    public static $hooks = ['addproduct', 'updateproduct', 'deleteproduct', 'categoryUpdate', 'displayHome', 'displayOrderConfirmation2', 'displayCrossSellingShoppingCart', 'actionAdminGroupsControllerSaveAfter'];
    
}