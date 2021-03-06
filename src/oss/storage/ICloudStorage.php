<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/9/9
 * Time: 15:40
 */

namespace lishuo\oss\storage;


use lishuo\oss\response\DeleteResponse;
use lishuo\oss\response\PutResponse;

interface ICloudStorage
{
    /**
     * 根据配置类初始化云API
     * @param StorageConfig $config
     * @return mixed
     */
    public function init(StorageConfig $config);

    /**
     * 指定操作的存储桶
     * @param string $bucket 存储桶名称
     * @return mixed
     */
    public function bucket(string $bucket);

    /**
     * 文件列表查询
     * @param int $limit 查询条目数
     * @param string $delimiter 要分隔符分组结果
     * @param string $prefix 指定key前缀查询
     * @param string $marker 标明本次列举文件的起点
     * @return mixed
     */
    public function get(int $limit, string $delimiter = '', string $prefix = '', string $marker = '');

    /**
     * 单文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 包含扩展名的完整文件路径
     * @return PutResponse
     */
    public function put(string $key, string $path): PutResponse;

    /**
     * 分块文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 包含扩展名的完整文件路径
     * @param int|null $partSize 指定块大小
     * @return PutResponse
     */
    public function putPart(string $key, string $path, int $partSize = null): PutResponse;

    /**
     * 删除指定key的文件
     * @param array $keys 待删除的key数组
     * @return DeleteResponse
     */
    public function delete(array $keys): DeleteResponse;
}