<?php
namespace Infini;

class Attributes
{
    public static function Map(array $variables): array
    {
            $attr = array();
            foreach ($variables as $var => $val) {
                $out = $var. '="' .$val. '"';
                $attr[] = $out;
            }
            return $attr;
    }

    public static function Combine(array $variables): string
    {
           $attrs = '';
           foreach ($variables as $var) {
               $attrs .= ' ' .$var;
           }
           return $attrs;
    }
}