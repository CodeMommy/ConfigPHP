<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once('library/Autoload.php');

use CodeMommy\ConfigPHP\Library\Autoload;

$autoloaDirectory = array(
    'library' => 'CodeMommy\\ConfigPHP\\Library',
    'class' => 'CodeMommy\\ConfigPHP',
    'interface' => 'CodeMommy\\ConfigPHP'
);

Autoload::directory($autoloaDirectory);
