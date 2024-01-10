<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcf516bda84d3ef425f988c0ba26f6809
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitcf516bda84d3ef425f988c0ba26f6809', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcf516bda84d3ef425f988c0ba26f6809', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcf516bda84d3ef425f988c0ba26f6809::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}