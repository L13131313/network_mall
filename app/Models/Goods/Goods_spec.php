<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class Goods_spec extends Model
{
    //表名
    public $table = 'goods_spec';
    // 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;
}
