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
class Config implements ConfigInterface
{
    /**
     * Config Directory
     * @var array
     */
    private static $configDirectory = array();

    /**
     * Cache
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
     * Support File YAML
     * @return array
     */
    private static function supportFileYAML()
    {
        if (class_exists('Symfony\\Component\\Yaml\\Yaml')) {
            return array('yaml', 'yml');
        }
        return array();
    }

    /**
     * Support File PHP
     * @return array
     */
    private static function supportFilePHP()
    {
        return array('php');
    }

    /**
     * Parse File
     * @param string $filePath
     * @return mixed
     */
    private static function parseFile($filePath = '')
    {
        $supportFileType = array();
        $supportFileType = array_merge($supportFileType, self::supportFilePHP());
        $supportFileType = array_merge($supportFileType, self::supportFileYAML());
        foreach ($supportFileType as $value) {
            $file = sprintf('%s.%s', $filePath, $value);
            if (is_file($file)) {
                if (in_array($value, self::supportFilePHP())) {
                    return require($file);
                }
                if (in_array($value, self::supportFileYAML())) {
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
     * Clear Cache
     */
    public static function clearCache()
    {
        self::$cache = array();
        return true;
    }

    /**
     * Get
     * @param $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        if (isset(self::$cache[$key])) {
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
            if (!is_array($config) || !isset($config[$keys[$index]])) {
                return $default;
            }
            $config = $config[$keys[$index]];
        }
        self::$cache[$key] = $config;
        return $config;
    }
}
