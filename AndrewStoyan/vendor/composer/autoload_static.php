<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite7958a00b264b0eb4f867f37986b7ed1
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'arrays\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'arrays\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite7958a00b264b0eb4f867f37986b7ed1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite7958a00b264b0eb4f867f37986b7ed1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
