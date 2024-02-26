<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22df3cf451c6637a2dae9b6279cc6b28
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        'b33e3d135e5d9e47d845c576147bda89' => __DIR__ . '/..' . '/php-di/php-di/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'L' => 
        array (
            'Laravel\\SerializableClosure\\' => 28,
        ),
        'I' => 
        array (
            'Invoker\\' => 8,
            'Infrastructure\\' => 15,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
        'D' => 
        array (
            'Domain\\' => 7,
            'DI\\' => 3,
        ),
        'A' => 
        array (
            'Application\\' => 12,
            'Adapter\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Laravel\\SerializableClosure\\' => 
        array (
            0 => __DIR__ . '/..' . '/laravel/serializable-closure/src',
        ),
        'Invoker\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-di/invoker/src',
        ),
        'Infrastructure\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Infrastructure',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'Domain\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Domain',
        ),
        'DI\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-di/php-di/src',
        ),
        'Application\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Application',
        ),
        'Adapter\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Adapter',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22df3cf451c6637a2dae9b6279cc6b28::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22df3cf451c6637a2dae9b6279cc6b28::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit22df3cf451c6637a2dae9b6279cc6b28::$classMap;

        }, null, ClassLoader::class);
    }
}