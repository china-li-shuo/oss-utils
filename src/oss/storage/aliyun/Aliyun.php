<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/9/9
 * Time: 15:45
 */

namespace lishuo\oss\storage\aliyun;


use OSS\Core\OssException;
use OSS\Model\ObjectListInfo;
use OSS\OssClient;
use lishuo\oss\exception\ConfigException;
use lishuo\oss\response\DeleteResponse;
use lishuo\oss\response\PutResponse;
use lishuo\oss\storage\ICloudStorage;
use lishuo\oss\storage\StorageConfig;

class Aliyun implements ICloudStorage
{

    /**
     * @var OssClient
     */
    private $ossClient;

    /**
     * @var string;
     */
    private $bucket;

    /**
     * 根据配置类初始化云API
     * @param StorageConfig $config
     * @return \qinchen\oss\storage\aliyun\Aliyun
     * @throws OssException
     * @throws ConfigException
     */
    public function init(StorageConfig $config): Aliyun
    {
        $config->checkParams();
        $this->ossClient = new OssClient($config->getAppId(), $config->getAppKey(), $config->getRegion());
        return $this;
    }

    /**
     * 指定操作的存储桶
     * @param string $bucket 存储桶名称
     * @return Aliyun
     */
    public function bucket(string $bucket): Aliyun
    {
        $this->bucket = $bucket;
        return $this;
    }

    /**
     * 文件列表查询
     * @param int $limit 查询条目数
     * @param string $delimiter 要分隔符分组结果
     * @param string $prefix 指定key前缀查询
     * @param string $marker
     * @return ObjectListInfo
     * @throws OssException
     */
    public function get(int $limit, string $delimiter = '', string $prefix = '', string $marker = '')
    {
        $options = [
            'delimiter' => $delimiter,
            'prefix' => $prefix,
            'max-keys' => $limit,
            'marker' => $marker,
        ];
        return $this->ossClient->listObjects($this->bucket, $options);
    }

    /**
     * 单文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 字符串内容或包含扩展名的文件完整本地路径
     * @return PutResponse
     * @throws OssException|ConfigException
     */
    public function put(string $key, string $path): PutResponse
    {
        if (!is_file($path)) {
            throw new ConfigException("Parameter 2 must be a valid file path");
        }

        $ossRes = $this->ossClient->uploadFile($this->bucket, $key, $path);
        return new PutResponse($key, $ossRes);
    }

    /**
     * 分块文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 字符串内容或包含扩展名的文件完整本地路径
     * @param int|null $partSize 指定块大小
     * @return PutResponse
     * @throws OssException
     */
    public function putPart(string $key, string $path, int $partSize = null): PutResponse
    {
        $options = array(
            OssClient::OSS_CHECK_MD5 => true,
            OssClient::OSS_PART_SIZE => $partSize ?: 10 * 1024 * 1024,
        );
        $multiuploadFile = $this->ossClient->multiuploadFile($this->bucket, $key, $path, $options);

        return new PutResponse($key, $multiuploadFile);
    }

    /**
     * 删除指定key的文件
     * @param array $keys 待删除的key数组
     * @return DeleteResponse
     */
    public function delete(array $keys): DeleteResponse
    {
        $ossRes = $this->ossClient->deleteObjects($this->bucket, $keys);
        return new DeleteResponse($keys, $ossRes);
    }
}