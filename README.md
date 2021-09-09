# oss-sdk

一个集成阿里云、腾讯云、七牛云对象存储的SDK

An SDK integrating Alibaba cloud, Tencent cloud and qiniu cloud object storage

超级快速使用阿里云OSS或腾讯COS及七牛云Koa获取、放置、删除对象

Supper quick use Aliyun OSS or Tencent COS or Qiniu Koa to get、put、delete Object.

## Installation

```php

composer require china-li-shuo/oss-sdk

```

## example

```php
use lishuo\oss\Manager;
use lishuo\oss\storage\StorageConfig;

    // string $appId, string $appKey, string $region
    $config = new StorageConfig("控制台查看获取", "控制台查看获取", "七牛云不需要配置这个参数，留空字符串");

    $storage = Manager::storage("云存储厂商") // 阿里云：aliyun、腾讯云：tencent、七牛云：qiniu
        ->init($config) // 初始化配置
        ->bucket("存储桶名称"); // 指定操作的存储桶

    // 查看文件列表
    $storage->get(10); // 指定查看10条
    // 上传文件
    $path = "./test.jpg";
    $result = $storage->put("test.jpg", $path);
    // 删除文件
    $keys = ['test.jpg'];
    $result = $storage->delete($keys);
```

