<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //表名
    public $table = 'goods';
 	// 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;

    /**
     * 关联商品规格表
     */
    public function goods_spec()
    {
        return $this->hasMany('App\Models\Goods\Goods_spec', 'gid', 'id');
    }

    /**
     * 关联商品详情表
     */
    public function goods_details()
    {
        return $this->hasMany('App\Models\Goods\Goods_details', 'gid', 'id');
    }
}
