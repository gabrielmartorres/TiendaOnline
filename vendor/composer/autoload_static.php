<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa58e9005df302ad8c6c939a3554336a
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Zebra_Pagination' => __DIR__ . '/..' . '/stefangabos/zebra_pagination/Zebra_Pagination.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitfa58e9005df302ad8c6c939a3554336a::$classMap;

        }, null, ClassLoader::class);
    }
}
