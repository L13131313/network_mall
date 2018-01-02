<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class Goods_attr extends Model
{
    //表名
    public $table = 'goods_attr';
    // 主键
    public $primaryKey = 'attrid';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;

    /**
     * 关联属性值表
     */
    public function attr_val()
    {
        return $this->hasMany('App\Models\Goods\Goods_attr_val', 'attrid', 'attrid');
    }
}
