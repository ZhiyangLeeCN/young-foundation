<?php

/**
 * author: LiZhiYang
 * email: zhiyanglee@foxmail.com
 */

namespace YoungFoundation;

use Hprose\Http\Server;

class RpcApplication
{
    /**
     *
     * @var Server
     */
    private $rpcHttpServer;

    /**
     *  需要发布的方法
     *
     * @var array
     */
    private $registerFuncs = [];

    /**
     * RpcApplication constructor.
     */
    public function __construct()
    {
        $this->rpcHttpServer = new Server();
    }

    /**
     *  注册一个同步方法
     *
     * @param $func
     * @param string $alias
     * @throws \Exception
     */
    public function registerSync($func, $alias = '')
    {
        $this->registerFuncs[] = [
            'func'      =>  $func,
            'alias'     =>  $alias,
            'options'   =>  []
        ];
    }

    /**
     *  注册一个异步方法
     *
     * @param $func
     * @param string $alias
     */
    public function registerAsync($func, $alias = '')
    {
        $this->registerFuncs[] = [
            'func'      =>  $func,
            'alias'     =>  $alias,
            'options'   =>  [
                'async' =>  true
            ]
        ];
    }

    /**
     *  注册一个oneway方法(只管发送，不等待服务器返回)
     *
     * @param $func
     * @param string $alias
     */
    public function registerOneway($func, $alias = '')
    {
        $this->registerFuncs[] = [
            'func'      =>  $func,
            'alias'     =>  $alias,
            'options'   =>  [
                'oneway' =>  true
            ]
        ];
    }

    /**
     *  发布RPC方法
     *
     * @throws \Exception
     */
    public function publish()
    {
        foreach ($this->registerFuncs as $registerFunc) {

            $this->rpcHttpServer->addFunction(
                $registerFunc['func'],
                $registerFunc['alias'],
                $registerFunc['options']
            );

        }
    }

    /**
     * 运行RPC应用
     */
    public function run()
    {
        $this->rpcHttpServer->start();
    }
}