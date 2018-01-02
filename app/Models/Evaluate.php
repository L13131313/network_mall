<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    //表名
    public $table = 'evaluate';
    // 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;

    /**
     * 关联商品表
     */
    public function goods()
    {
        return $this->belongsTo('App\Models\Goods\Goods', 'gid', 'id');
    }

}
