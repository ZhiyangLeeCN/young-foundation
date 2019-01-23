<?php

/**
 * author: LiZhiYang
 * email: zhiyanglee@foxmail.com
 */

namespace YoungFoundation\Rpc;

use Hprose\Http\Server;

class RpcApplication
{
    /**
     *
     * @var Server
     */
    private $rpcHttpServer;

    /**
     * @var RpcRegister
     */
    private $rpcRegisters;

    /**
     *  添加RPC注册器
     *
     * @param RpcRegister $rpcRegister
     */
    public function addRpcRegister(RpcRegister $rpcRegister)
    {
        $this->rpcHttpServer = new Server();
        $this->rpcRegisters[] = $rpcRegister;
    }

    /**
     *  发布RPC方法
     *
     * @throws \Exception
     */
    public function publish()
    {
        foreach ($this->rpcRegisters as $rpcRegister) {

            foreach ($rpcRegister as $registerFunc) {

                $this->rpcHttpServer->addFunction(
                    $registerFunc['func'],
                    $registerFunc['alias'],
                    $registerFunc['options']
                );

            }

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