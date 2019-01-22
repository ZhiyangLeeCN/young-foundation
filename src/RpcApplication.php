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
     * @var RpcRegister
     */
    private $rpcRegister;

    /**
     * RpcApplication constructor.
     * @param RpcRegister $rpcRegister
     */
    public function __construct(RpcRegister $rpcRegister)
    {
        $this->rpcRegister = $rpcRegister;
    }

    /**
     *  发布RPC方法
     *
     * @throws \Exception
     */
    public function publish()
    {
        foreach ($this->rpcRegister as $registerFunc) {

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