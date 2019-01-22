<?php
/**
 * author: LiZhiYang
 * email: zhiyanglee@foxmail.com
 */

namespace YoungFoundation;


class RpcRegister implements \IteratorAggregate
{
    private $functions = [];

    /**
     *  注册一个同步方法
     *
     * @param $func
     * @param string $alias
     * @throws \Exception
     */
    public function addSync($func, $alias = '')
    {
        $this->functions[] = [
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
    public function addAsync($func, $alias = '')
    {
        $this->functions[] = [
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
    public function addOneway($func, $alias = '')
    {
        $this->functions[] = [
            'func'      =>  $func,
            'alias'     =>  $alias,
            'options'   =>  [
                'oneway' =>  true
            ]
        ];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->functions);
    }
}