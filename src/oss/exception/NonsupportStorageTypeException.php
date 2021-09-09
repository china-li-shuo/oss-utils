<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/9/9
 * Time: 15:34
 */

namespace lishuo\oss\exception;


class NonsupportStorageTypeException extends \Exception
{
    protected $message = "不支持该类型云存储";
}