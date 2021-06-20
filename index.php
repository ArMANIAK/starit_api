<?php

require_once __DIR__ . '/classes/Request.php';
require_once __DIR__ . '/classes/DbConnect.php';
require_once __DIR__ . '/classes/api/Api.php';
require_once __DIR__ . '/classes/api/FboApi.php';
require_once __DIR__ . '/classes/api/BusinessApi.php';

// use classes\api\FboApi;
// use classes\api\Api;

$request = new Request();
$apiName = $request->resource . 'Api';
$api = new $apiName($request);
