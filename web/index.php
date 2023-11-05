<?php
declare(strict_types = 1);

require_once 'vendor/autoload.php';

const TEMPLATE_DIR = __DIR__ . '/src/templates/';

use Agro\System\Agro;

ini_set('display_errors', '1');
error_reporting(E_ALL);

new Agro;
