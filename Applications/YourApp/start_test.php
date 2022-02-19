<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \GatewayWorker\Register;
use \GatewayWorker\Gateway;
//echo 'start ....'.PHP_EOL;Websocket
// 创建一个Worker监听2345端口，使用http协议通讯tcp
require_once __DIR__ . '/../../vendor/autoload.php';

$websocket_worker =new Gateway("Websocket://0.0.0.0:5002" );
$websocket_worker->name = 'WebsocketGateway';
$websocket_worker->registerAddress = '127.0.0.1:1238';
$websocket_worker->startPort = 4630;
// 启动4个进程对外提供服务
$websocket_worker->count = 4;
$websocket_worker->pingInterval = 45;
$websocket_worker->pingNotResponseLimit=3;
$websocket_worker->pingData = '{"code":0,"message":"心跳","content":{"type":"ping"},"contentEncrypt":""}';

//echo swoole_strerror(swoole_last_error(), 9) . PHP_EOL;
//echo swoole_strerror(SWOOLE_ERROR_MALLOC_FAIL, 9) . PHP_EOL;
//echo swoole_strerror(SWOOLE_ERROR_SYSTEM_CALL_FAIL, 9) . PHP_EOL;
//
//echo '信息3'.PHP_EOL;

//// 接收到浏览器发送的数据时回复hello world给浏览器
//$websocket_worker->onMessage = function ($connection, $data) {
////    var_dump(11111111);
//    // 向浏览器发送hello world
//    //$connection->send("<scipt>javascipt::alert('hello world websocket!');</scipt>");
//    //var_dump($data);
//    $connection->send("11111111111");
//};

// 如果不是在根目录启动，则运行runAll方法
if (!defined('GLOBAL_START')) {
    Worker::runAll();
}

