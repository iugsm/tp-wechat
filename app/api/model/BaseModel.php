<?php


namespace app\api\model;


use think\Model;
use think\model\concern\SoftDelete;

class BaseModel extends Model
{
    // 使用软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    // 自动时间戳
    protected $autoWriteTimestamp = true;

}