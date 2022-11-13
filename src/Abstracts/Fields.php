<?php

namespace Yeganehha\DynamicForm\Abstracts;

abstract class Fields implements \Yeganehha\DynamicForm\Interfaces\FieldInterface
{

    public function field(string $name, mixed $value = null, string $class = null, string $style = null, array $atterbutes): string
    {
        $html = "<input type=\"text\" name=\"".$name."\" ";
        if ( $value )
            $html .= "value=\"".$value."\" ";
        if ( $class )
            $html .= "class=\"".$class."\" ";
        if ( $style )
            $html .= "style=\"".$style."\" ";
        if ( $atterbutes )
            foreach ($atterbutes as $atterbute => $atterbute_value)
            $html .= $atterbute."=\"".$atterbute_value."\" ";
        $html .= "/>\n";
        return $html;
    }

    public function value(mixed $value = null): string
    {
        return (string) $value ?? "-";
    }
}
