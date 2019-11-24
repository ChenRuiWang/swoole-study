<?php

use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

$server = new Server("127.0.0.1", 8000);

// 连接是触发
$server->on("open", function (Server $server, Request $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});


$server->on("message", function (Server $server, Frame $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on("close", function (Server $server, $fd) {
    echo "client {$fd} close.";
});

$server->start();