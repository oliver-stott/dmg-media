<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ec0c8808835517bfac244ef6a9fc241
{
    public static $files = array (
        '3937806105cc8e221b8fa8db5b70d2f2' => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/includes/functions.php',
        'be01b9b16925dcb22165c40b46681ac6' => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib/cli/cli.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'M' => 
        array (
            'Mustangostang\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Mustangostang\\' => 
        array (
            0 => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'c' => 
        array (
            'cli' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib',
            ),
        ),
        'W' => 
        array (
            'WP_CLI\\' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/wp-cli/php',
            ),
        ),
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WP_CLI' => __DIR__ . '/..' . '/wp-cli/wp-cli/php/class-wp-cli.php',
        'WP_CLI_Command' => __DIR__ . '/..' . '/wp-cli/wp-cli/php/class-wp-cli-command.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ec0c8808835517bfac244ef6a9fc241::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ec0c8808835517bfac244ef6a9fc241::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7ec0c8808835517bfac244ef6a9fc241::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7ec0c8808835517bfac244ef6a9fc241::$classMap;

        }, null, ClassLoader::class);
    }
}
