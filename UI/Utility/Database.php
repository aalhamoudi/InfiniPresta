<?php

namespace Infini;

class Database {
	public static function Execute($query)
	{
		$query = $query?? '
				UPDATE `'._DB_PREFIX_.'homeslider_slides` SET `position` = '.(int)$position.'
				WHERE `id_homeslider_slides` = '.(int)$id_slide;

		$slides = Tools::getValue('slides');
		$res = Db::getInstance()->execute($query);
		$ui->clearCache();

		return $res;
	}
}


