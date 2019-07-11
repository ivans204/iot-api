<?php
namespace Ivans\Facades;

class File extends Facade
{
    public static function __callStatic($name, $arguments)
    {
        return self::getFacadeAncestor('file');
    }
}