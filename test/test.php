<?php

/**
 * @author   Candison November <www.kandisheng.com>
 */

require_once(__DIR__ . '/../source/Config.php');

use CodeMommy\ConfigPHP\Config;

Config::setRoot('./');
$result = Config::get('application.config.test.hello', 'default');
var_dump($result);