<?php

/**
 * CodeMommy ConfigPHP
 * @author Candison November <www.kandisheng.com>
 */

require_once('library/Autoload.php');

use CodeMommy\ConfigPHP\Library\Autoload;

$autoloaDirectory = array(
    'library' => 'CodeMommy\\ConfigPHP\\Library',
    'interface' => 'CodeMommy\\ConfigPHP',
    'class' => 'CodeMommy\\ConfigPHP'
);

Autoload::directory($autoloaDirectory);
