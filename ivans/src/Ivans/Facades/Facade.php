<?php
namespace Ivans\Facades;


class Facade
{
    public static function getFacadeAncestor($ancestor)
    {
        return $app->find($ancestor);
    }
}