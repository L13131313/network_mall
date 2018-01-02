<?php

namespace App\Models\lunbo;

use Illuminate\Database\Eloquent\Model;

class Lunbo extends Model
{
    //表名
    public $table = 'lunbo';
 	// 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;

    public function Shops()
    {
        //与店铺表关联
        return $this->hasOne('App\Models\Shops\Shops', 'id', 'shopid');
    }

}
