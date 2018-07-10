<?php

namespace app\admin\model;

use think\Model;

class Brand extends Model
{
    // 表名
    protected $name = 'brand';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];

    /*定义status状态*/
    public function getStatusAttr($value)
    {
        $status = [1=>'待审核',2=>'流转中',10=>'审核通过',41=>'被驳回'];
        return $status[$value];
    }


    

    







    public function brandtags()
    {
        return $this->belongsTo('BrandTags', 'tag_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
