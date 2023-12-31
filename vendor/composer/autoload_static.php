<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce8f2c8551b5057936823f99eb83fab2
{
    public static $files = array (
        'bbaa5f97c4fb6f7042deb9669b63ec79' => __DIR__ . '/../..' . '/config/config.ini.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
        'L' => 
        array (
            'Library\\' => 8,
        ),
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Library\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce8f2c8551b5057936823f99eb83fab2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce8f2c8551b5057936823f99eb83fab2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce8f2c8551b5057936823f99eb83fab2::$classMap;

        }, null, ClassLoader::class);
    }
}
