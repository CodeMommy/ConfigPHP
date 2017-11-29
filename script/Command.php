<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ConfigPHP\Script;

use CodeMommy\TaskPHP\Console;
use CodeMommy\TaskPHP\FileSystem;

/**
 * Class Command
 * @package CodeMommy\ConfigPHP\Script;
 */
class Command
{
    /**
     * Command constructor.
     */
    public function __construct()
    {
    }

    /**
     * Clean Report
     */
    public static function cleanReport()
    {
        $removeList = array(
            '.report'
        );
        $result = FileSystem::remove($removeList);
        if ($result) {
            Console::printLine('Clean Report Finished.', 'success');
        } else {
            Console::printLine('Error.', 'error');
        }
    }
}
