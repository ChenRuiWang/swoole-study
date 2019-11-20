<?php

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;


$http = new Server("0.0.0.0", "9501");

$http->on("request", function (Request $request, Response $response) {
    $uid = $request->get['uid'] ?? 1;
    $uname = $request->get['uname'] ?? "RandyChan";
    $response->end("<h1>Hello {$uname}. #".rand(1000, 9999)." --- UID: {$uid}</h1>");
});

$http->start();