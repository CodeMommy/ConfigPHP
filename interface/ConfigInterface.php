<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ConfigPHP;

/**
 * Interface ConfigInterface
 * @package CodeMommy\ConfigPHP
 */
interface ConfigInterface
{
    /**
     * ConfigInterface constructor.
     */
    public function __construct();

    /**
     * Add Directory
     * @param string $directory
     * @return mixed
     */
    public static function addDirectory($directory = '.');

    /**
     * Clear Cache
     * @return mixed
     */
    public static function clearCache();

    /**
     * Get
     * @param $key
     * @param null $default
     * @return mixed
     */
    public static function get($key, $default = null);
}
