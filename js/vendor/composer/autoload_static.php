<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitff2d7b9cf129777d87f4fcdc78537c46
{
    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'RetailCrm\\' => 
            array (
                0 => __DIR__ . '/..' . '/retailcrm/api-client-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitff2d7b9cf129777d87f4fcdc78537c46::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}