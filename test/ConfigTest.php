<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\ConfigPHP\Test;

use CodeMommy\ConfigPHP\Config;

/**
 * Class ConfigTest
 * @package CodeMommy\ConfigPHP\Test
 */
class ConfigTest extends BaseTest
{
    /**
     * ConfigTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Construct
     */
    public function testConstruct()
    {
        new Config();
        $this->assertTrue(true);
    }

    /**
     * Test Add Directory
     * @return void
     */
    public function testAddDirectory()
    {
        $this->assertEquals(Config::addDirectory($this->getTestCasePath()), true);
    }

    /**
     * Test Clear Cache
     * @return void
     */
    public function testClearCache()
    {
        $this->assertEquals(Config::clearCache(), true);
    }

    /**
     * Test Get From Directory
     * @return void
     */
    public function testGetFromDirectory()
    {
        Config::addDirectory($this->getTestCasePath());
        $this->assertEquals(Config::get('php.file.type'), 'php');
        $this->assertEquals(Config::get('demo.php.file.type'), 'php');
        $this->assertEquals(Config::get('yaml.file.type'), 'yaml');
        $this->assertEquals(Config::get('yml.file.type'), 'yml');
        $this->assertEquals(Config::get('php.file.type.no', 'default'), 'default');
        // From Cache
        $this->assertEquals(Config::get('php.file.type'), 'php');
    }
}
