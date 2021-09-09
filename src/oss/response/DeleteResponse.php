<?php
/**
 * Author: 李硕
 * Email: kezuo@foxmail.com
 * Date: 2021/9/9
 * Time: 15:35
 */

namespace lishuo\oss\response;


class DeleteResponse
{
    private $deleted;

    private $sourceData;

    /**
     * PutResponse constructor.
     * @param $deleted
     * @param $sourceData
     */
    public function __construct(array $deleted, $sourceData)
    {
        $this->deleted = $deleted;
        $this->sourceData = $sourceData;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return mixed
     */
    public function getSourceData(): array
    {
        return $this->sourceData;
    }
}