<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a64ab4cc686a28b8c9ca056e889cc3b
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sa\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sa\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a64ab4cc686a28b8c9ca056e889cc3b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a64ab4cc686a28b8c9ca056e889cc3b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
