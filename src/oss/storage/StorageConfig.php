<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/9/9
 * Time: 15:41
 */

namespace lishuo\oss\storage;


use lishuo\oss\exception\ConfigException;

class StorageConfig
{

    private $appId;

    private $appKey;

    private $region;


    /**
     * StorageConfig constructor.
     * @param string $appId 云 API 密钥，请到相应云存储平台的控制台获取
     * 腾讯云为SecretId
     * 阿里云为AccessKeyId
     * 七牛云为AccessKeY
     *
     * @param string $appKey 云 API 密钥，请到相应云存储平台的控制台获取
     * 腾讯云为SecretKey
     * 阿里云为AccessKeySecret
     * 七牛云为SecretKey
     *
     * @param string $region 存储区域
     */
    public function __construct(string $appId, string $appKey, string $region)
    {
        $this->appId = $appId;
        $this->appKey = $appKey;
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * 配置参数基础检查
     * @return bool
     * @throws ConfigException
     */
    public function checkParams(): bool
    {
        $objectVars = get_object_vars($this);
        foreach ($objectVars as $key => $value) {
            if (is_null($value)) {
                throw new ConfigException("配置参数{$key}未配置");
            }
        }
        return true;
    }
}