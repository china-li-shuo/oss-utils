# 介绍（oss-utils）

一个集成阿里云、腾讯云、七牛云对象存储的工具类

An SDK integrating Alibaba cloud, Tencent cloud and qiniu cloud object storage

超级快速使用阿里云OSS或腾讯COS及七牛云Koa获取、放置、删除对象

Supper quick use Aliyun OSS or Tencent COS or Qiniu Koa to get、put、delete Object.

## 安装（Installation）

```php
composer require china-lishuo/oss-utils
```

## 案列（example）

```php
use lishuo\oss\Manager;
use lishuo\oss\storage\StorageConfig;

    // 参数1：string $appId
    // 参数2：string $appKey
    // 参数3：string $region 地域名、比如（1）阿里云上海为例（http://oss-cn-shanghai.aliyuncs.com）（2）腾讯云上海为例（sh）直接地域名首字母即可（3）其它Region请按实际情况填写。
    
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

## 报错参考（Error reporting）

腾讯云本地上传报错：cURL error 60: SSL certificate problem: self signed certificate in certificate chain

解决方案：https://juejin.cn/post/7012052806337036301/
