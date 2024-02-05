<?php
require "../../vendor/autoload.php";

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'] . '/models']);

$openapi->saveAs($_SERVER['DOCUMENT_ROOT'] . '/swagger.json');

header('Content-Type: application/json');
echo $openapi->toJSON();
