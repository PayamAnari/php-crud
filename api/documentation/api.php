<?php

require "vendor/autoload.php";

$openapi = \OpenApi\Generator::scan(['/path/to/project']);

header('Content-Type: application/x-json');
echo $openapi->toJSON();
