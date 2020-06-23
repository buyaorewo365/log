<?php

/**
 * this is  a Seaslog sdk
 * author lyj
 * email 313535835@qq.com
 */

namespace Banjulog;


class Logger
{
    private $message;
    public function add($message)
    {
        $this->message = json_encode($message);
    }
    public function get()
    {
        return $this->message;
    }
}
