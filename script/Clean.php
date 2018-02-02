<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ConfigPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class Clean
 * @package CodeMommy\ConfigPHP\Script;
 */
class Clean
{
    /**
     * Clean constructor.
     */
    public function __construct()
    {
    }

    /**
     * Workbench
     */
    public static function workbench()
    {
        $removeList = array(
            'workbench'
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Finished.', 'success');
            return;
        }
        Console::printLine('Clean Error.', 'error');
        return;
    }

    /**
     * PHPUnit
     */
    public static function phpUnit()
    {
        PHPUnit::clean();
    }

    /**
     * All
     */
    public static function all()
    {
        self::workbench();
        self::phpUnit();
    }
}
