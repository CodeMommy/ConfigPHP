<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\ConfigPHP\Config;

/**
 * Class ConfigTest
 * @package Test
 */
class ConfigTest extends TestCase
{
    /**
     * @var string
     */
    private $testDirectory = '';

    /**
     * ConfigTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->testDirectory = sprintf('%s/case', __DIR__);
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
        $this->assertEquals(Config::addDirectory($this->testDirectory), true);
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
        Config::addDirectory($this->testDirectory);
        $this->assertEquals(Config::get('php.file.type'), 'php');
        $this->assertEquals(Config::get('demo.php.file.type'), 'php');
        $this->assertEquals(Config::get('yaml.file.type'), 'yaml');
        $this->assertEquals(Config::get('yml.file.type'), 'yml');
        $this->assertEquals(Config::get('php.file.type.no', 'default'), 'default');
        // From Cache
        $this->assertEquals(Config::get('php.file.type'), 'php');
    }
}
