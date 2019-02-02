<?php
use Infini\Attributes;

class UX
{
    // {hook h='<hook_name>' mod='<module_name>'}
    public static function Hook(string $hook, string $module = ''): string
    {
        return Hook::exec($hook);
    }

    // {widget name='<module_name>' hook='<hook_name>'}
    public static function Widget(Module $module, string $hook, array $params): string
    {
        return Hook::coreRenderWidget($module, $hook, $params);
    }
    public static function RenderForm(string $name, string $base = '/shop/modules/ui/'): string
    {
        $vars = [
            'schemaUrl' => $base.'schema/'.$name.'.json',
            'endpoint' => $base.'api/'.$name.'.php'
        ];

        return static::RenderComponent('Form', $vars);
    }



    public static function RenderComponent(string $name, array $variables): string
    {
        $attrs = Attributes::Combine(Attributes::Map($variables));
        return '<Infini-' .$name." id='".$name."' ".$attrs. '></' .$name. '>';
    }

}


