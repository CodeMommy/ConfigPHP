<?php

/**
 * CodeMommy ConfigPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ConfigPHP;

/**
 * Class Config
 * @package CodeMommy\ConfigPHP
 */
class Config
{
    private static $root = '.';

    /**
     * Set Root
     *
     * @param string $root
     */
    public static function setRoot($root = '.')
    {
        $root = str_replace('\\', '/', $root);
        if (substr($root, -1) == '/') {
            $root = substr($root, 0, -1);
        }
        self::$root = $root;
    }

    /**
     * Get
     *
     * @param $key
     * @param mixed $default
     *
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $index = 0;
        $filePath = '';
        $config = null;
        $keys = explode('.', $key);
        $count = count($keys);
        for (; $index < $count; $index++) {
            $filePath .= '/' . $keys[$index];
            $file = self::$root . $filePath . '.php';
            if (is_file($file)) {
                $config = require_once($file);
                break;
            }
        }
        for ($index += 1; $index < $count; $index++) {
            if (!isset($config[$keys[$index]])) {
                return $default;
            }
            $config = $config[$keys[$index]];
        }
        return $config;
    }
}