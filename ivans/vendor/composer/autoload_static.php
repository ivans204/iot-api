<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53f330ed1cdd5a70bd7667d501dc6f36
{
    public static $files = array (
        '024b8c68bcbbdcea247080f7a6231711' => __DIR__ . '/../..' . '/src/Ivans/helpers.php',
    );

    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'Ivans' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit53f330ed1cdd5a70bd7667d501dc6f36::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}