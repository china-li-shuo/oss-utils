<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/8/31
 * Time: 15:59
 */

namespace lishuo\src\oss;

class Manager
{

    public function index()
    {
        return 'hello world';
    }

    /**
     * 获取指定云存储实例
     * @param string $type 云存储类型，阿里云：aliyun、腾讯云：tencent、七牛云：qiniu
     * @return Aliyun|Tencent 具体类型云存储实例
     * @throws NonsupportStorageTypeException
     */
    public static function storage(string $type)
    {
        $storage = null;
        switch ($type) {
            case "aliyun":
                $storage = new Aliyun();
                break;
            case "tencent":
                $storage = new Tencent();
                break;
            case "qiniu":
                $storage = new Qiniu();
                break;
            default:
                throw new NonsupportStorageTypeException();
        }
        return $storage;
    }
}