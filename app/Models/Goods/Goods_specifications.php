<?php

namespace App\Models\goods;

use Illuminate\Database\Eloquent\Model;

class Goods_specifications extends Model
{
    //表名
    public $table = 'goods_specifications';
    // 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;
}
