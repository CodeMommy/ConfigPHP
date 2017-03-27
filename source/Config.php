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
    private static $root = './';

    /**
     * Set Root
     *
     * @param string $root
     */
    public static function setRoot($root = './')
    {
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
            $file = self::$root . substr($filePath, 1) . '.php';
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