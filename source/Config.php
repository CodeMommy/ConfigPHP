<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ConfigPHP;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 * @package CodeMommy\ConfigPHP
 */
class Config
{
    /**
     * @var array
     */
    private static $configDirectory = array();

    /**
     * @var array
     */
    private static $cache = array();

    /**
     * Config constructor.
     */
    public function __construct()
    {
    }

    /**
     * Parse File
     * @param string $filePath
     * @return mixed
     */
    private static function parseFile($filePath = '')
    {
        $supportFileType = array('php', 'yaml', 'yml');
        foreach ($supportFileType as $value) {
            $file = sprintf('%s.%s', $filePath, $value);
            if (is_file($file)) {
                if ($value == 'php') {
                    return require($file);
                }
                if ($value == 'yaml' || $value == 'yml') {
                    return Yaml::parse(file_get_contents($file));
                }
            }
        }
        return null;
    }

    /**
     * Add Directory
     * @param string $directory
     * @return bool
     */
    public static function addDirectory($directory = '.')
    {
        $directory = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $directory);
        $directory = rtrim($directory, '/\\');
        $directory = empty($directory) ? '.' : $directory;
        array_push(self::$configDirectory, $directory);
        return true;
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
        if(isset(self::$cache[$key])){
            return self::$cache[$key];
        }
        $index = 0;
        $filePath = '';
        $config = null;
        $keys = explode('.', $key);
        $count = count($keys);
        for (; $index < $count; $index++) {
            $filePath .= DIRECTORY_SEPARATOR . $keys[$index];
            foreach (self::$configDirectory as $directory) {
                $fileContent = self::parseFile($directory . $filePath);
                $config = empty($fileContent) ? $config : $fileContent;
                if (!empty($config)) {
                    break 2;
                }
            }
        }
        for ($index += 1; $index < $count; $index++) {
            if (!isset($config[$keys[$index]])) {
                return $default;
            }
            $config = $config[$keys[$index]];
        }
        self::$cache[$key] = $config;
        return $config;
    }
}
