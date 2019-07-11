<?php
use Ivans\Facades\File;


if(!function_exists('config')) {
    function config($pathToConfig) {
        // database.name should retrieve database.php  name value
        // database.somevar.somethingelse should retrieve database.php  somevar somethingelse value

        $path = explode('.', $pathToConfig); // ['database', 'name']

        $require = require_once __DIR__ . '/config/' . $param[0] . '.php';

        if(count($path) <= 1) { // ['database']
            // (new File())->get();
            return File::get('database.name');
        }
        return $require;
    }
}