<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11bb28467997708f573e9effe8d8de6b
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'twitter\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'twitter\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11bb28467997708f573e9effe8d8de6b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11bb28467997708f573e9effe8d8de6b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
